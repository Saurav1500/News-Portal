<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            UserSeeder::class,
            NewsSeeder::class,
            CrawlSourceSeeder::class,
        ]);
    }
}
