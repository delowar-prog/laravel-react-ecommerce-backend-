<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisions = [
            ['id' => '1', 'name' => 'Chattagram', 'bn_name' => 'চট্টগ্রাম', 'url' => 'www.chittagongdiv.gov.bd'],
            ['id' => '2', 'name' => 'Rajshahi', 'bn_name' => 'রাজশাহী', 'url' => 'www.rajshahidiv.gov.bd'],
            ['id' => '3', 'name' => 'Khulna', 'bn_name' => 'খুলনা', 'url' => 'www.khulnadiv.gov.bd'],
            ['id' => '4', 'name' => 'Barisal', 'bn_name' => 'বরিশাল', 'url' => 'www.barisaldiv.gov.bd'],
            ['id' => '5', 'name' => 'Sylhet', 'bn_name' => 'সিলেট', 'url' => 'www.sylhetdiv.gov.bd'],
            ['id' => '6', 'name' => 'Dhaka', 'bn_name' => 'ঢাকা', 'url' => 'www.dhakadiv.gov.bd'],
            ['id' => '7', 'name' => 'Rangpur', 'bn_name' => 'রংপুর', 'url' => 'www.rangpurdiv.gov.bd'],
            ['id' => '8', 'name' => 'Mymensingh', 'bn_name' => 'ময়মনসিংহ', 'url' => 'www.mymensinghdiv.gov.bd'],
        ];
        Division::insert($divisions);
    }
}
