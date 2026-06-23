<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            SolutionsSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
            PageSeeder::class,
            PartnerSeeder::class,
            NewsletterSubscriberSeeder::class,
            PageViewSeeder::class,
        ]);
    }
}
