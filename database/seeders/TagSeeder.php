<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'राजनीति', 'अर्थतन्त्र', 'समाज', 'खेलकुद', 'प्रविधि',
            'मनोरञ्जन', 'जीवनशैली', 'विचार', 'अन्तर्राष्ट्रिय',
            'स्वास्थ्य', 'शिक्षा', 'पर्यटन', 'व्यापार', 'कृषि',
            'नेपाल', 'काठमाडौं', 'पोखरा', 'चीन', 'भारत', 'अमेरिका',
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($tag)],
                ['name' => $tag]
            );
        }
    }
}
