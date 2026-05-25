<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {

        // Candy
        $candy = Category::create([
            'name' => 'Candy'
        ]);

        Product::create([
            'name' => 'Lollipop',
            'image' => 'product-images/lollipop.jpg',
            'price' => 1.50,
            'description' => 'A colorful sweet lollipop with a fruity flavor. Perfect for a quick sugar treat.',
            'category_id' => $candy->id
        ]);


        // Caviar
        Category::create([
            'name' => 'Caviar'
        ]);


        // Dairy
        $dairy = Category::create([
            'name' => 'Dairy'
        ]);

        Product::create([
            'name' => 'Cheese',
            'image' => 'product-images/cheese.jpg',
            'price' => 5.90,
            'description' => 'A rich and creamy cheese made from fresh milk. Perfect for sandwiches, cooking, or snacks.',
            'category_id' => $dairy->id
        ]);

        Product::create([
            'name' => 'Milk',
            'image' => 'product-images/milk.jpg',
            'price' => 2.30,
            'description' => 'Fresh dairy milk with a smooth taste. Great for drinking, cereal, or cooking.',
            'category_id' => $dairy->id
        ]);


        // Fruits
        $fruits = Category::create([
            'name' => 'Fruits'
        ]);

        Product::create([
            'name' => 'Banana',
            'image' => 'product-images/banana.jpg',
            'price' => 1.20,
            'description' => 'A naturally sweet banana packed with potassium and energy. A healthy everyday snack.',
            'category_id' => $fruits->id
        ]);

        Product::create([
            'name' => 'Melon',
            'image' => 'product-images/melon.jpg',
            'price' => 3.80,
            'description' => 'A juicy and refreshing melon with a sweet taste, perfect for summer snacks and fruit salads.',
            'category_id' => $fruits->id
        ]);

        Product::create([
            'name' => 'Orange',
            'image' => 'product-images/orange.jpg',
            'price' => 1.60,
            'description' => 'A fresh citrus orange full of vitamin C. Ideal for juicing or eating fresh.',
            'category_id' => $fruits->id
        ]);


        // Meat
        $meat = Category::create([
            'name' => 'Meat'
        ]);

        Product::create([
            'name' => 'Hot Dog',
            'image' => 'product-images/hotdog.jpg',
            'price' => 3.50,
            'description' => 'A classic hot dog sausage made from seasoned meat. Perfect for grilling or quick meals.',
            'category_id' => $meat->id
        ]);
    }
}
