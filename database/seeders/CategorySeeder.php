<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = base_path('storage/app/public/categories.json');

        if (!file_exists($filePath)) {
            return;
        }

        $data = json_decode(file_get_contents(base_path('storage/app/public/categories.json')), true);

        if (!$data) {
            return;
        }

        foreach ($data as $categoryName => $services) {
            $category = Category::create(['name' => $categoryName]);

            foreach ($services as $serviceName) {
                Service::create([
                    'name' => $serviceName,
                    'category_id' => $category->id
                ]);
            }
        }
    }
}