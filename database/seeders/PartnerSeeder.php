<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name'       => 'Gojek Indonesia',
                'url'        => 'https://gojek.com',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'name'       => 'Tokopedia',
                'url'        => 'https://tokopedia.com',
                'sort_order' => 2,
                'is_active'  => true,
            ],
            [
                'name'       => 'Traveloka',
                'url'        => 'https://traveloka.com',
                'sort_order' => 3,
                'is_active'  => true,
            ],
            [
                'name'       => 'Bukalapak',
                'url'        => 'https://bukalapak.com',
                'sort_order' => 4,
                'is_active'  => true,
            ],
            [
                'name'       => 'Blibli',
                'url'        => 'https://blibli.com',
                'sort_order' => 5,
                'is_active'  => true,
            ],
        ];

        foreach ($partners as $data) {
            Partner::updateOrCreate(
                ['name' => $data['name']],
                $data
            );
        }

        $this->command->info('✅ PartnerSeeder completed successfully.');
    }
}
