<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure tags exist
        $tags = collect(['ERP', 'IoT', 'Logistics', 'Digital Transformation', 'Efficiency'])->map(function ($tagName) {
            return Tag::firstOrCreate([
                'name' => $tagName,
                'slug' => \Illuminate\Support\Str::slug($tagName),
            ]);
        });

        // Get category IDs
        $techCat = Category::where('slug', 'technology-innovation')->first();
        $bizCat = Category::where('slug', 'business-strategy')->first();

        if (!$techCat || !$bizCat) {
            $this->command->error('❌ Categories must be seeded first! Running CategorySeeder...');
            return;
        }

        // 2. Define posts
        $posts = [
            [
                'title'            => 'Why Cloud ERP is the Future of Manufacturing',
                'slug'             => 'why-cloud-erp-is-the-future-of-manufacturing',
                'excerpt'          => 'Cloud ERP systems are transforming the manufacturing industry by unifying data and automating operational workflows.',
                'body'             => '<p>Enterprise Resource Planning (ERP) in the cloud offers manufacturers unprecedented flexibility, scalability, and integration. In this article, we look at why cloud-based systems are outperforming legacy on-premise solutions...</p>',
                'category_id'      => $techCat->id,
                'author_name'      => 'Budi Santoso',
                'reading_time'     => 5,
                'status'           => 'published',
                'published_at'     => now()->subDays(10),
                'is_featured'      => true,
                'seo_title'        => 'Cloud ERP in Manufacturing — Innovation Project',
                'seo_description'  => 'Discover the benefits of cloud ERP systems for modern manufacturing companies.',
                'tags_to_attach'   => ['ERP', 'Digital Transformation']
            ],
            [
                'title'            => 'Optimizing Warehouse Operations with IoT Sensors',
                'slug'             => 'optimizing-warehouse-operations-with-iot-sensors',
                'excerpt'          => 'Learn how Internet of Things (IoT) hardware and sensors can optimize warehouse layout and cycle counting.',
                'body'             => '<p>Deploying environmental and RFID tracking sensors within logistics centers gives supply chain operators real-time data to prevent stock loss and accelerate picker productivity...</p>',
                'category_id'      => $techCat->id,
                'author_name'      => 'Ahmad Fauzi',
                'reading_time'     => 7,
                'status'           => 'published',
                'published_at'     => now()->subDays(7),
                'is_featured'      => false,
                'seo_title'        => 'Warehouse IoT Solutions — Innovation Project',
                'seo_description'  => 'How IoT sensors improve inventory visibility in warehouses.',
                'tags_to_attach'   => ['IoT', 'Logistics']
            ],
            [
                'title'            => 'Calculating the True ROI of Custom Software Development',
                'slug'             => 'calculating-the-true-roi-of-custom-software-development',
                'excerpt'          => 'Is custom software worth the investment? Learn how to audit, measure, and calculate the return on investment.',
                'body'             => '<p>When choosing between off-the-shelf software and custom solutions, companies must look beyond the initial price tag to analyze implementation speed, adoption rates, and operational overheads...</p>',
                'category_id'      => $bizCat->id,
                'author_name'      => 'Dewi Lestari',
                'reading_time'     => 6,
                'status'           => 'published',
                'published_at'     => now()->subDays(5),
                'is_featured'      => false,
                'seo_title'        => 'Measuring Software ROI — Innovation Project',
                'seo_description'  => 'A complete business guide to calculating the ROI of custom enterprise applications.',
                'tags_to_attach'   => ['Digital Transformation', 'Efficiency']
            ],
            [
                'title'            => '5 Ways to Eliminate Bottlenecks in Last-Mile Logistics',
                'slug'             => '5-ways-to-eliminate-bottlenecks-in-last-mile-logistics',
                'excerpt'          => 'Last-mile delivery is often the most expensive part of logistics. Here are 5 ways to optimize it using a TMS.',
                'body'             => '<p>By integrating route optimization algorithms and driver tracking apps, dispatchers can save up to 20% on fuel costs while boosting customer satisfaction levels...</p>',
                'category_id'      => $bizCat->id,
                'author_name'      => 'Budi Santoso',
                'reading_time'     => 4,
                'status'           => 'published',
                'published_at'     => now()->subDays(2),
                'is_featured'      => false,
                'seo_title'        => 'Last-Mile Logistics Optimization — Innovation Project',
                'seo_description'  => 'Optimize delivery schedules and carrier networks to save freight expenses.',
                'tags_to_attach'   => ['Logistics', 'Efficiency']
            ],
            [
                'title'            => 'A Guide to Transitioning from Spreadsheets to Automated MRP',
                'slug'             => 'a-guide-to-transitioning-from-spreadsheets-to-automated-mrp',
                'excerpt'          => 'Manual spreadsheets restrict your manufacturing scalability. Transitioning to automated MRP prevents stockouts.',
                'body'             => '<p>Managing bill of materials and supplier lead times in Excel is a recipe for operational failure. An automated Material Resource Planning system recalculates requirements instantly...</p>',
                'category_id'      => $techCat->id,
                'author_name'      => 'Dewi Lestari',
                'reading_time'     => 8,
                'status'           => 'published',
                'published_at'     => now()->subDay(),
                'is_featured'      => true,
                'seo_title'        => 'Transition to Automated MRP — Innovation Project',
                'seo_description'  => 'Step-by-step blueprint to migrate production scheduling away from spreadsheets.',
                'tags_to_attach'   => ['ERP', 'Efficiency']
            ],
        ];

        foreach ($posts as $postData) {
            $tagsToAttach = $postData['tags_to_attach'];
            unset($postData['tags_to_attach']);

            $post = Post::updateOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            // Attach tags
            $tagIds = Tag::whereIn('name', $tagsToAttach)->pluck('id');
            $post->tags()->sync($tagIds);
        }

        $this->command->info('✅ PostSeeder completed successfully.');
    }
}
