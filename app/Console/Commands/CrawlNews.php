<?php

namespace App\Console\Commands;

use App\Services\CrawlService;
use Illuminate\Console\Command;

class CrawlNews extends Command
{
    protected $signature = 'news:crawl {--source= : क्रल स्रोत ID}';
    protected $description = 'विभिन्न समाचार साइटहरूबाट समाचार क्रल गर्ने';

    public function handle(CrawlService $crawlService)
    {
        $this->info('समाचार क्रल सुरु गर्दै...');

        if ($sourceId = $this->option('source')) {
            $source = \App\Models\CrawlSource::find($sourceId);
            if (!$source) {
                $this->error("स्रोत ID {$sourceId} फेला परेन।");
                return 1;
            }
            $result = $crawlService->crawl($source);
            $this->info($result['message']);
        } else {
            $results = $crawlService->crawlAll();
            foreach ($results as $id => $result) {
                $sourceName = \App\Models\CrawlSource::find($id)?->name ?? "स्रोत #{$id}";
                $icon = $result['success'] ? '✓' : '✗';
                $this->line(" {$icon} {$sourceName}: {$result['message']}");
            }
            $total = collect($results)->sum('count');
            $this->newLine();
            $this->info("कुल {$total} वटा समाचार क्रल गरियो।");
        }

        return 0;
    }
}
