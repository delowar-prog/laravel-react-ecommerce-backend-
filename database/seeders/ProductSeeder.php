<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Phones
            [
                'title' => 'Apple iPhone 14',
                'short_des' => 'The latest Apple smartphone with advanced features.',
                'price' => 999,
                'discount' => 10,
                'discount_price' => 899,
                'image' => 'uploads/products/iphone14.jpg',
                'stock' => 50,
                'star' => 5,
                
                'category_id' => 1, // Phone
                'brand_id' => 1, // Apple
            ],
            [
                'title' => 'Samsung Galaxy S23',
                'short_des' => 'A high-performance smartphone from Samsung.',
                'price' => 899,
                'discount' => 15,
                'discount_price' => 764,
                'image' => 'uploads/products/s23.jpg',
                'stock' => 70,
                'star' => 4,
                
                'category_id' => 1, // Phone
                'brand_id' => 2, // Samsung
            ],
            [
                'title' => 'Google Pixel 7',
                'short_des' => 'Capture the perfect moment with Google’s Pixel 7.',
                'price' => 799,
                'discount' => 12,
                'discount_price' => 703,
                'image' => 'uploads/products/pixel7.png',
                'stock' => 65,
                'star' => 4,
                
                'category_id' => 1, // Phone
                'brand_id' => 3, // Google
            ],
            [
                'title' => 'OnePlus 11',
                'short_des' => 'Fast, smooth, and stylish flagship phone.',
                'price' => 699,
                'discount' => 10,
                'discount_price' => 629,
                'image' => 'uploads/products/oneplus11.jpg',
                'stock' => 80,
                'star' => 4,
                
                'category_id' => 1, // Phone
                'brand_id' => 4, // OnePlus
            ],
            [
                'title' => 'Xiaomi Mi 13 Pro',
                'short_des' => 'Affordable flagship smartphone with powerful features.',
                'price' => 599,
                'discount' => 15,
                'discount_price' => 509,
                'image' => 'uploads/products/xiaomi13.jpg',
                'stock' => 90,
                'star' => 4,
                
                'category_id' => 1, // Phone
                'brand_id' => 5, // Xiaomi
            ],

            // Laptops
            [
                'title' => 'Dell XPS 13 Laptop',
                'short_des' => 'Ultra-portable laptop with powerful features.',
                'price' => 1199,
                'discount' => 10,
                'discount_price' => 1079,
                'image' => 'uploads/products/dellxps13.jpg',
                'stock' => 40,
                'star' => 5,
                
                'category_id' => 2, // Laptop
                'brand_id' => 6, // Dell
            ],
            [
                'title' => 'MacBook Air M2',
                'short_des' => 'Apple’s thinnest and lightest laptop with the M2 chip.',
                'price' => 1299,
                'discount' => 5,
                'discount_price' => 1234,
                'image' => 'uploads/products/macbook-m2.png',
                'stock' => 30,
                'star' => 5,
                
                'category_id' => 2, // Laptop
                'brand_id' => 1, // Apple
            ],
            [
                'title' => 'Asus ROG Zephyrus G14',
                'short_des' => 'High-performance gaming laptop with AMD Ryzen.',
                'price' => 1599,
                'discount' => 8,
                'discount_price' => 1471,
                'image' => 'uploads/products/asus-rog.png',
                'stock' => 20,
                'star' => 5,
                
                'category_id' => 2, // Laptop
                'brand_id' => 6, // Asus
            ],
            [
                'title' => 'HP Spectre x360',
                'short_des' => '2-in-1 premium laptop with stunning display.',
                'price' => 1499,
                'discount' => 10,
                'discount_price' => 1349,
                'image' => 'uploads/products/hp-spectre-x360.jpg',
                'stock' => 25,
                'star' => 5,
                
                'category_id' => 2, // Laptop
                'brand_id' => 7, // HP
            ],
            [
                'title' => 'Lenovo ThinkPad X1 Carbon',
                'short_des' => 'Professional laptop with ultra-light design.',
                'price' => 1399,
                'discount' => 12,
                'discount_price' => 1231,
                'image' => 'products/Lenovo-ThinkPad-X1-Carbon.jpg',
                'stock' => 35,
                'star' => 5,
                
                'category_id' => 2, // Laptop
                'brand_id' => 8, // Lenovo
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
