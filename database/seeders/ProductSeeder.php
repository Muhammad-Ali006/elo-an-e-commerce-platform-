<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Men > Tops (category 5)
            [
                'category_id' => 5,
                'name' => 'Classic Fit Oxford Shirt',
                'description' => 'Premium cotton oxford shirt with button-down collar. Perfect for casual and formal occasions.',
                'price' => 4500,
                'sale_price' => 3500,
                'stock' => 50
            ],
            [
                'category_id' => 5,
                'name' => 'Linen Blend Casual Shirt',
                'description' => 'Lightweight linen blend shirt ideal for summer. Available in multiple colors.',
                'price' => 3800,
                'stock' => 40
            ],
            [
                'category_id' => 5,
                'name' => 'Graphic Print T-Shirt',
                'description' => 'Soft cotton tee with unique graphic print. Regular fit with ribbed collar.',
                'price' => 1800,
                'stock' => 100
            ],

            // Men > Bottoms (category 6)
            [
                'category_id' => 6,
                'name' => 'Slim Fit Chinos',
                'description' => 'Stretch cotton chinos in khaki. Modern slim fit with comfortable waistband.',
                'price' => 3500,
                'stock' => 60
            ],
            [
                'category_id' => 6,
                'name' => 'Cargo Joggers',
                'description' => 'Cotton blend joggers with side pockets and elastic cuffs.',
                'price' => 2800,
                'sale_price' => 2200,
                'stock' => 45
            ],

            // Men > Footwear (category 7)
            [
                'category_id' => 7,
                'name' => 'Leather Loafers',
                'description' => 'Genuine leather loafers with cushioned insole. Handcrafted for lasting comfort.',
                'price' => 6500,
                'stock' => 30
            ],

            // Women > Dresses (category 9)
            [
                'category_id' => 9,
                'name' => 'Floral Midi Dress',
                'description' => 'Elegant floral print midi dress with cinched waist and flowy silhouette.',
                'price' => 5200,
                'sale_price' => 4200,
                'stock' => 35
            ],
            [
                'category_id' => 9,
                'name' => 'Wrap Bodycon Dress',
                'description' => 'Figure-flattering wrap dress in stretch jersey fabric. Perfect for evening wear.',
                'price' => 4800,
                'stock' => 25
            ],

            // Women > Tops (category 10)
            [
                'category_id' => 10,
                'name' => 'Off-Shoulder Blouse',
                'description' => 'Romantic off-shoulder blouse with ruffle trim and lightweight fabric.',
                'price' => 3200,
                'stock' => 55
            ],
            [
                'category_id' => 10,
                'name' => 'Cropped Knit Sweater',
                'description' => 'Cozy cropped sweater in soft acrylic blend. Features ribbed cuffs and hem.',
                'price' => 2900,
                'sale_price' => 2300,
                'stock' => 40
            ],

            // Women > Accessories (category 11)
            [
                'category_id' => 11,
                'name' => 'Leather Crossbody Bag',
                'description' => 'Genuine leather crossbody bag with adjustable strap and multiple compartments.',
                'price' => 5500,
                'stock' => 20
            ],
            [
                'category_id' => 11,
                'name' => 'Gold Hoop Earrings',
                'description' => '18k gold-plated hoop earrings. Lightweight and hypoallergenic.',
                'price' => 1800,
                'sale_price' => 1400,
                'stock' => 80
            ],

            // Kids > T-Shirts (category 13)
            [
                'category_id' => 13,
                'name' => 'Cartoon Character Tee',
                'description' => 'Fun cartoon print t-shirt in 100% organic cotton. Machine washable.',
                'price' => 1200,
                'stock' => 90
            ],
            [
                'category_id' => 13,
                'name' => 'Color Block Polo',
                'description' => 'Sporty color block polo shirt with button placket and embroidered logo.',
                'price' => 1500,
                'stock' => 65
            ],

            // Kids > Shoes (category 14)
            [
                'category_id' => 14,
                'name' => 'Lightweight Sneakers',
                'description' => 'Breathable mesh sneakers with flexible sole and hook-and-loop closure.',
                'price' => 2800,
                'sale_price' => 2200,
                'stock' => 40
            ],

            // Electronics
            [
                'category_id' => 3,
                'name' => 'Wireless Bluetooth Earbuds',
                'description' => 'True wireless earbuds with active noise cancellation and 24hr battery life.',
                'price' => 8500,
                'sale_price' => 6500,
                'stock' => 50
            ],
            [
                'category_id' => 3,
                'name' => 'Smart Fitness Band',
                'description' => 'Track your health with heart rate monitor, sleep tracking, and step counter.',
                'price' => 4500,
                'stock' => 35
            ],

            // Books
            [
                'category_id' => 4,
                'name' => 'The Art of Clean Code',
                'description' => 'Master the principles of writing clean, maintainable, and efficient code.',
                'price' => 2200,
                'stock' => 70
            ],

            // Home & Kitchen
            [
                'category_id' => 15,
                'name' => 'Ceramic Coffee Mug Set',
                'description' => 'Set of 4 handcrafted ceramic mugs with minimalist design. Microwave safe.',
                'price' => 2500,
                'sale_price' => 1900,
                'stock' => 60
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
