<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\WorkCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesData = [
            'Technology' => [
                ['name' => 'Web Development', 'active' => true],
                ['name' => 'Mobile App Development', 'active' => true],
                ['name' => 'IT Support', 'active' => true],
            ],
            'Health & Wellness' => [
                ['name' => 'Personal Training', 'active' => true],
                ['name' => 'Nutrition Counseling', 'active' => true],
                ['name' => 'Mental Health Coaching', 'active' => true],
            ],
            'Education' => [
                ['name' => 'Online Tutoring', 'active' => true],
                ['name' => 'Curriculum Design', 'active' => true],
                ['name' => 'Exam Preparation', 'active' => true],
            ],
            'Entertainment' => [
                ['name' => 'Music Lessons', 'active' => true],
                ['name' => 'Film Production', 'active' => true],
                ['name' => 'Event Planning', 'active' => true],
            ],
            'Automotive' => [
                ['name' => 'Car Repair', 'active' => true],
                ['name' => 'Car Rental', 'active' => true],
                ['name' => 'Car Detailing', 'active' => true],
            ],
            'Food & Beverage' => [
                ['name' => 'Catering', 'active' => true],
                ['name' => 'Food Delivery', 'active' => true],
                ['name' => 'Restaurant Services', 'active' => true],
            ],
            'Retail' => [
                ['name' => 'Clothing Store', 'active' => true],
                ['name' => 'Electronics Store', 'active' => true],
                ['name' => 'Furniture Store', 'active' => true],
            ],
            'Construction' => [
                ['name' => 'Home Renovation', 'active' => true],
                ['name' => 'Electrical Work', 'active' => true],
                ['name' => 'Plumbing Services', 'active' => true],
            ],
            'Finance' => [
                ['name' => 'Tax Consultation', 'active' => true],
                ['name' => 'Investment Advice', 'active' => true],
                ['name' => 'Financial Planning', 'active' => true],
            ],
            'Real Estate' => [
                ['name' => 'Property Listing', 'active' => true],
                ['name' => 'Real Estate Agent', 'active' => true],
                ['name' => 'Property Management', 'active' => true],
            ],
        ];

        foreach ($servicesData as $categoryName => $services) {
            $category = WorkCategory::where('name', $categoryName)->first();

            foreach ($services as $serviceData) {
                Service::create([
                    'work_category_id' => $category->id,
                    'name' => $serviceData['name'],
                    'active' => $serviceData['active'],
                ]);
            }
        }
    }
}
