<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'राजनीति', 'slug' => 'politics', 'description' => 'राजनीतिक समाचार र विश्लेषण', 'is_active' => true, 'display_order' => 1],
            ['name' => 'अर्थतन्त्र', 'slug' => 'economy', 'description' => 'आर्थिक समाचार र बजार जानकारी', 'is_active' => true, 'display_order' => 2],
            ['name' => 'समाज', 'slug' => 'society', 'description' => 'सामाजिक समाचार र मुद्दाहरू', 'is_active' => true, 'display_order' => 3],
            ['name' => 'अन्तर्राष्ट्रिय', 'slug' => 'international', 'description' => 'अन्तर्राष्ट्रिय समाचार', 'is_active' => true, 'display_order' => 4],
            ['name' => 'प्रविधि', 'slug' => 'technology', 'description' => 'प्रविधि र डिजिटल समाचार', 'is_active' => true, 'display_order' => 5],
            ['name' => 'खेलकुद', 'slug' => 'sports', 'description' => 'खेलकुद समाचार', 'is_active' => true, 'display_order' => 6],
            ['name' => 'मनोरञ्जन', 'slug' => 'entertainment', 'description' => 'मनोरञ्जन र कला समाचार', 'is_active' => true, 'display_order' => 7],
            ['name' => 'जीवनशैली', 'slug' => 'life-style', 'description' => 'जीवनशैली र स्वास्थ्य समाचार', 'is_active' => true, 'display_order' => 8],
            ['name' => 'बिजनेस', 'slug' => 'business', 'description' => 'व्यापार र उद्योग समाचार', 'is_active' => true, 'display_order' => 9],
            ['name' => 'विचार', 'slug' => 'opinion', 'description' => 'विचार र सम्पादकीय', 'is_active' => true, 'display_order' => 10],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}
