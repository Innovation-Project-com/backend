<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * Run order:
     *  1. AdminUserSeeder   — creates the Filament admin user
     *  2. SiteSettingSeeder — seeds global site configuration
     *  3. SolutionsSeeder   — seeds all 5 published solutions (ERP, TMS, WMS, MRP, IoT)
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            SiteSettingSeeder::class,
            SolutionsSeeder::class,
        ]);
    }
}

