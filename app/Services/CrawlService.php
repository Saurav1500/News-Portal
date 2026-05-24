<?php

namespace App\Services;

use App\Models\CrawlSource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CrawlService
{
    public function crawl(CrawlSource $source)
    {
        try {
            $response = Http::timeout(30)->get($source->url);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'message' => "HTTP त्रुटि: {$response->status()}",
                    'count' => 0,
                ];
            }

            $html = $response->body();
            $count = $this->extractAndSave($html, $source);

            $source->update(['last_crawled_at' => now()]);

            return [
                'success' => true,
                'message' => "{$count} वटा समाचार क्रल गरियो।",
                'count' => $count,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => "क्रल गर्न असफल: {$e->getMessage()}",
                'count' => 0,
            ];
        }
    }

    protected function extractAndSave($html, CrawlSource $source)
    {
        $count = 0;

        preg_match_all('/<article[^>]*>(.*?)<\/article>/is', $html, $articleMatches);

        if (empty($articleMatches[0])) {
            preg_match_all('/<div[^>]*class="[^"]*(?:post|news|story|entry)[^"]*"[^>]*>(.*?)<\/div>/is', $html, $articleMatches);
        }

        if (empty($articleMatches[0])) {
            $rawItems = [];
            preg_match_all('/<a[^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/is', $html, $linkMatches);
            $seenUrls = [];
            foreach ($linkMatches[1] as $i => $url) {
                if (count($rawItems) >= 5) break;
                if (isset($seenUrls[$url])) continue;
                if (strlen($linkMatches[2][$i]) < 30) continue;
                $seenUrls[$url] = true;
                $rawItems[] = [
                    'title' => strip_tags($linkMatches[2][$i]),
                    'url' => $url,
                ];
            }

            foreach ($rawItems as $item) {
                $existingNews = News::where('source_url', $item['url'])->orWhere('title', $item['title'])->exists();
                if ($existingNews) continue;

                $news = News::create([
                    'title' => trim($item['title']),
                    'slug' => Str::slug($item['title']) . '-' . uniqid(),
                    'category_id' => $source->category_id,
                    'summary' => Str::limit(trim($item['title']), 200),
                    'content' => trim($item['title']),
                    'author' => $source->name,
                    'email' => 'crawler@newsai.com',
                    'priority' => 'normal',
                    'is_draft' => false,
                    'is_published' => true,
                    'terms_accepted' => true,
                    'source' => $source->name,
                    'source_url' => $item['url'],
                    'published_at' => now(),
                ]);

                $count++;
            }

            return $count;
        }

        $seenTitles = [];
        foreach ($articleMatches[1] as $articleHtml) {
            if ($count >= 10) break;

            preg_match('/<h[1-6][^>]*>(.*?)<\/h[1-6]>/is', $articleHtml, $titleMatch);
            preg_match('/<p[^>]*>(.*?)<\/p>/is', $articleHtml, $descMatch);
            preg_match('/<a[^>]*href="([^"]+)"[^>]*>/is', $articleHtml, $linkMatch);

            $title = $titleMatch ? strip_tags($titleMatch[1]) : null;
            if (!$title) continue;

            $title = trim($title);
            if (isset($seenTitles[$title]) || strlen($title) < 10) continue;
            $seenTitles[$title] = true;

            $existingNews = News::where('source_url', $linkMatch[1] ?? '')
                ->orWhere('title', $title)
                ->exists();
            if ($existingNews) continue;

            $news = News::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'category_id' => $source->category_id,
                'summary' => $descMatch ? Str::limit(strip_tags($descMatch[1]), 200) : Str::limit($title, 200),
                'content' => $descMatch ? strip_tags($descMatch[1]) : $title,
                'author' => $source->name,
                'email' => 'crawler@newsai.com',
                'priority' => 'normal',
                'is_draft' => false,
                'is_published' => true,
                'terms_accepted' => true,
                'source' => $source->name,
                'source_url' => $linkMatch[1] ?? $source->url,
                'published_at' => now(),
            ]);

            $count++;
        }

        return $count;
    }

    public function crawlAll()
    {
        $sources = CrawlSource::active()->get();
        $results = [];

        foreach ($sources as $source) {
            $results[$source->id] = $this->crawl($source);
        }

        return $results;
    }
}
