<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Technology & Innovation',
                'slug'        => 'technology-innovation',
                'description' => 'Latest trends in software, IoT, cloud computing and automation.',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'name'        => 'Business Strategy',
                'slug'        => 'business-strategy',
                'description' => 'Operations, scalability, ROI analysis, and workflow optimization.',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }

        $this->command->info('✅ CategorySeeder completed successfully.');
    }
}
