<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'products_count' => Product::count(),
            'categories_count' => Category::count(),
            'users_count' => User::count(),
            'orders_count' => Order::count(),
            'low_stock_count' => Product::where('stock', '<', 10)->count(),
            'recent_orders' => Order::with('items')->latest()->take(5)->get(),
            'low_stock_products' => Product::with('category')->where('stock', '<', 10)->orderBy('stock')->take(5)->get(),
        ];

        return view('admin.dashboard', $stats);
    }

    private function buildCategoryTree($categories, $parentId = null, $prefix = '')
    {
        $result = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parentId) {
                $category->hierarchy_name = $prefix . $category->name;
                $result[] = $category;
                $result = array_merge($result, $this->buildCategoryTree($categories, $category->id, $prefix . '— '));
            }
        }
        return $result;
    }

    // --- PRODUCTS ---
    public function products()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function productsCreate()
    {
        $categories = $this->buildCategoryTree(Category::all());
        return view('admin.products.create', compact('categories'));
    }

    public function productsStore(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $sortOrder => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'sort_order' => $sortOrder,
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function productsEdit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = $this->buildCategoryTree(Category::all());
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productsUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $sortOrder => $file) {
                $path = $file->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'sort_order' => $product->images()->count() + $sortOrder,
                ]);
            }
        }

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function productsDestroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
        }
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    public function productsDeleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }
        $image->delete();

        return back()->with('success', 'Image deleted.');
    }

    // --- CATEGORIES ---
    public function categories()
    {
        $categories = $this->buildCategoryTree(Category::withCount('products')->get());
        $allCategories = Category::all();
        return view('admin.categories.index', compact('categories', 'allCategories'));
    }

    public function categoriesStore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        Category::create($data);

        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    public function categoriesUpdate(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($data['parent_id'] == $id) {
            return back()->with('error', 'A category cannot be its own parent.');
        }

        $category->update($data);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function categoriesDestroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete category with existing products. Move or delete products first.');
        }
        if ($category->children()->count() > 0) {
            return back()->with('error', 'Cannot delete category with subcategories. Remove subcategories first.');
        }
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }

    // --- USERS ---
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function usersToggleAdmin($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot change your own admin status.');
        }
        $user->update(['is_admin' => !$user->is_admin]);

        return back()->with('success', 'User admin status updated.');
    }

    public function usersDestroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // --- ORDERS ---
    public function orders()
    {
        $orders = Order::with('items')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersShow($id)
    {
        $order = Order::with('items', 'user')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function ordersUpdateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);
        $order->update($data);

        return back()->with('success', 'Order status updated to ' . $data['status'] . '.');
    }

    public function ordersDestroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully.');
    }
}
