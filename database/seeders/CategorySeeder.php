<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Whole Raw Chicken'],
            ['name' => 'Chicken Breast'],
            ['name' => 'Drumsticks'],
            ['name' => 'Karahi Cut'],
            ['name' => 'Boneless Breast'],
            ['name' => 'Boneless Handi Cut'],
            ['name' => 'Chicken Wings'],
            ['name' => 'Chicken Qeema'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
