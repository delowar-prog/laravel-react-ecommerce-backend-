<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['brandName' => 'Apple', 'brandImg' => 'https://example.com/images/apple.png'],
            ['brandName' => 'Samsung', 'brandImg' => 'https://example.com/images/samsung.png'],
            ['brandName' => 'Sony', 'brandImg' => 'https://example.com/images/sony.png'],
            ['brandName' => 'Dell', 'brandImg' => 'https://example.com/images/dell.png'],
            ['brandName' => 'HP', 'brandImg' => 'https://example.com/images/hp.png'],
            ['brandName' => 'Lenovo', 'brandImg' => 'https://example.com/images/lenovo.png'],
            ['brandName' => 'Asus', 'brandImg' => 'https://example.com/images/asus.png'],
            ['brandName' => 'Microsoft', 'brandImg' => 'https://example.com/images/microsoft.png'],
            ['brandName' => 'Logitech', 'brandImg' => 'https://example.com/images/logitech.png'],
            ['brandName' => 'Bose', 'brandImg' => 'https://example.com/images/bose.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
