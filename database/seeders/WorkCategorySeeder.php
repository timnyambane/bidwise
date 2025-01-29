<?php

namespace Database\Seeders;

use App\Models\WorkCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology', 'active' => true],
            ['name' => 'Health & Wellness', 'active' => true],
            ['name' => 'Education', 'active' => true],
            ['name' => 'Entertainment', 'active' => true],
            ['name' => 'Automotive', 'active' => true],
            ['name' => 'Food & Beverage', 'active' => true],
            ['name' => 'Retail', 'active' => true],
            ['name' => 'Construction', 'active' => true],
            ['name' => 'Finance', 'active' => true],
            ['name' => 'Real Estate', 'active' => true],
        ];

        foreach ($categories as $category) {
            WorkCategory::create($category);
        }
    }
}
