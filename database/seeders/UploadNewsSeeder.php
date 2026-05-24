<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UploadNewsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'politics',
            'economy',
            'society',
            'international',
            'technology',
            'sports',
            'entertainment',
            'lifestyle',
            'business'
        ];

        $priorities = ['normal', 'high', 'urgent'];

        for ($i = 1; $i <= 15; $i++) {

            DB::table('upload_news')->insert([
                'title' => 'Sample News Title ' . $i,

                'category' => $categories[array_rand($categories)],

                'summary' => 'This is a short summary for sample news article ' . $i,

                'content' => 'This is the full detailed content of sample news article ' . $i .
                    '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',

                'author' => 'Author ' . $i,

                'email' => 'author' . $i . '@example.com',

                'image' => rand(0, 1) ? 'uploads/news/sample' . $i . '.jpg' : null,

                'tags' => 'Nepal,Politics,News',

                'priority' => $priorities[array_rand($priorities)],

                'is_draft' => rand(0, 1),

                'terms_accepted' => true,

                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
