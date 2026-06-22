<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(
            ['id' => 1],
            [
                'company_name'            => 'Innovation Project',
                'address'                 => 'Indonesia',
                'phone'                   => null,
                'email'                   => 'info@innovationproject.id',
                'logo'                    => null,
                'favicon'                 => null,
                'social_links'            => [
                    'linkedin' => null,
                    'twitter'  => null,
                    'youtube'  => null,
                ],
                'footer_text'             => '© ' . date('Y') . ' Innovation Project. All rights reserved.',
                'default_seo_title'       => 'Innovation Project — Cost-Effective IT Solutions for Your Business',
                'default_seo_description' => 'Innovation Project provides end-to-end IT solutions including ERP, TMS, WMS, MRP, and IoT for businesses. Consultative approach, cost-effective implementation.',
            ]
        );

        $this->command->info('✅ Site settings seeded successfully.');
    }
}
