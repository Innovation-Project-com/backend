<?php

namespace Database\Seeders;

use App\Models\NewsletterSubscriber;
use Illuminate\Database\Seeder;

class NewsletterSubscriberSeeder extends Seeder
{
    public function run(): void
    {
        $subscribers = [
            [
                'email'         => 'john.doe@example.com',
                'subscribed_at' => now()->subDays(20),
                'is_active'     => true,
            ],
            [
                'email'         => 'jane.smith@example.com',
                'subscribed_at' => now()->subDays(15),
                'is_active'     => true,
            ],
            [
                'email'         => 'michael.johnson@example.com',
                'subscribed_at' => now()->subDays(10),
                'is_active'     => true,
            ],
            [
                'email'         => 'sarah.connor@example.com',
                'subscribed_at' => now()->subDays(5),
                'is_active'     => true,
            ],
            [
                'email'         => 'bruce.wayne@example.com',
                'subscribed_at' => now()->subDay(),
                'is_active'     => true,
            ],
        ];

        foreach ($subscribers as $data) {
            NewsletterSubscriber::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }

        $this->command->info('✅ NewsletterSubscriberSeeder completed successfully.');
    }
}
