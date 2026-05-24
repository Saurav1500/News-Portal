<?php

namespace Database\Seeders;

use App\Models\CrawlSource;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CrawlSourceSeeder extends Seeder
{
    public function run(): void
    {
        $categoryMap = [];
        foreach (Category::all() as $cat) {
            $categoryMap[$cat->slug] = $cat->id;
        }

        $sources = [
            [
                'name' => 'सेतोपाटी - राजनीति',
                'url' => 'https://www.setopati.com/politics',
                'category_id' => $categoryMap['politics'] ?? null,
                'is_active' => true,
            ],
            [
                'name' => 'सेतोपाटी - अर्थ',
                'url' => 'https://www.setopati.com/economy',
                'category_id' => $categoryMap['economy'] ?? null,
                'is_active' => true,
            ],
            [
                'name' => 'अनलाइन खबर - राजनीति',
                'url' => 'https://www.onlinekhabar.com/politics',
                'category_id' => $categoryMap['politics'] ?? null,
                'is_active' => true,
            ],
            [
                'name' => 'अनलाइन खबर - खेलकुद',
                'url' => 'https://www.onlinekhabar.com/sports',
                'category_id' => $categoryMap['sports'] ?? null,
                'is_active' => true,
            ],
            [
                'name' => 'रातोपाटी - प्रविधि',
                'url' => 'https://www.ratopati.com/technology',
                'category_id' => $categoryMap['technology'] ?? null,
                'is_active' => true,
            ],
        ];

        foreach ($sources as $source) {
            CrawlSource::firstOrCreate(
                ['url' => $source['url']],
                $source
            );
        }
    }
}
