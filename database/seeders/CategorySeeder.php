<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Top-level categories
        $clothing = Category::create(['name' => 'Clothing']);
        $men = Category::create(['name' => 'Men', 'parent_id' => $clothing->id]);
        $women = Category::create(['name' => 'Women', 'parent_id' => $clothing->id]);
        $kids = Category::create(['name' => 'Kids', 'parent_id' => $clothing->id]);

        $electronics = Category::create(['name' => 'Electronics']);
        $books = Category::create(['name' => 'Books']);
        $home = Category::create(['name' => 'Home & Kitchen']);
        $sports = Category::create(['name' => 'Sports & Outdoors']);

        // Subcategories
        Category::create(['name' => 'Tops', 'parent_id' => $men->id]);
        Category::create(['name' => 'Bottoms', 'parent_id' => $men->id]);
        Category::create(['name' => 'Footwear', 'parent_id' => $men->id]);
        Category::create(['name' => 'Dresses', 'parent_id' => $women->id]);
        Category::create(['name' => 'Tops', 'parent_id' => $women->id]);
        Category::create(['name' => 'Accessories', 'parent_id' => $women->id]);
        Category::create(['name' => 'T-Shirts', 'parent_id' => $kids->id]);
        Category::create(['name' => 'Shoes', 'parent_id' => $kids->id]);
    }
}
