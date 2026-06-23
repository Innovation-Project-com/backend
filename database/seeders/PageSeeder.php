<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title'          => 'Company Home',
                'page_type'      => 'home',
                'hero_title'     => 'Empowering Businesses with Cost-Effective IT Solutions',
                'hero_subtitle'  => 'Innovation Project delivers world-class enterprise applications custom-tailored to optimize your operation.',
                'status'         => 'published',
                'published_at'   => now(),
                'seo_title'      => 'Innovation Project — Best Enterprise Solutions',
                'seo_description' => 'We design and deliver ERP, TMS, WMS, MRP, and IoT solutions for your business success.',
                'content_blocks' => [
                    [
                        'type' => 'hero_banner',
                        'data' => [
                            'badge' => 'INTELLIGENT OPERATION',
                            'title' => 'Empowering Businesses with Cost-Effective IT Solutions',
                            'subtitle' => 'Innovation Project delivers custom, enterprise-grade digital systems.',
                            'primary_cta_label' => 'Explore Solutions',
                            'primary_cta_url' => '/solutions',
                            'secondary_cta_label' => 'Contact Us',
                            'secondary_cta_url' => '/contact',
                        ]
                    ],
                    [
                        'type' => 'problem_section',
                        'data' => [
                            'title' => 'The Challenges of Modern Operations',
                            'subtitle' => 'Many businesses struggle to scale due to inefficient systems.',
                            'items' => [
                                [
                                    'code' => 'silos',
                                    'title' => 'Information Silos',
                                    'short' => 'Fragmented Data',
                                    'description' => 'Departments operate on separate databases, causing delays and errors in reporting.',
                                    'metric' => '65%',
                                    'progress' => 65,
                                    'image_url' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=500'
                                ],
                                [
                                    'code' => 'manual',
                                    'title' => 'Manual Overload',
                                    'short' => 'Repetitive Labor',
                                    'description' => 'Hours wasted keying in spreadsheet data instead of managing operations.',
                                    'metric' => '40h/wk',
                                    'progress' => 85,
                                    'image_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=500'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'why_us_section',
                        'data' => [
                            'title' => 'Why Partner with Us',
                            'subtitle' => 'We combine technical expertise with deep business analysis.',
                            'items' => [
                                [
                                    'title' => 'Consultative Approach',
                                    'description' => 'We do not just sell software; we audit and improve your workflow first.'
                                ],
                                [
                                    'title' => 'Cost-Effective Delivery',
                                    'description' => 'Flexible and scalable solutions that guarantee high ROI.'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'process_section',
                        'data' => [
                            'title' => 'Our Proven Methodology',
                            'subtitle' => 'A structured journey from audit to maintenance.',
                            'steps' => [
                                [
                                    'title' => '1. Audit & Analysis',
                                    'description' => 'We map your existing processes and identify bottleneck areas.'
                                ],
                                [
                                    'title' => '2. Custom Design & Build',
                                    'description' => 'We develop a modular solution custom to your workflow.'
                                ],
                                [
                                    'title' => '3. Deployment & Training',
                                    'description' => 'Hands-on onboarding to ensure high adoption rates.'
                                ]
                            ]
                        ]
                    ],
                    [
                        'type' => 'cta_section',
                        'data' => [
                            'title' => 'Ready to Digitalize Your Operations?',
                            'subtitle' => 'Schedule a free 1-hour consultation with our solutions architects today.',
                            'btn_label' => 'Schedule Call',
                            'btn_url' => '/contact'
                        ]
                    ]
                ]
            ]
        );

        $this->command->info('✅ PageSeeder completed successfully.');
    }
}
