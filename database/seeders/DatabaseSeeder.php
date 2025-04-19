<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\AssignOp\Div;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $this->call([
        UserSeeder::class,
        CategorySeeder::class,
        BrandSeeder::class,
        ProductSeeder::class,
        DivisionSeeder::class,
        DistrictSeeder::class,
        UpazilaSeeder::class,
        UnionSeeder::class,
       ]);
    }
}
