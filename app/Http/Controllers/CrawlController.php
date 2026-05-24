<?php

namespace App\Http\Controllers;

use App\Models\CrawlSource;
use App\Services\CrawlService;
use Illuminate\Http\Request;

class CrawlController extends Controller
{
    public function run(Request $request, CrawlService $crawlService)
    {
        if ($request->has('source')) {
            $source = CrawlSource::findOrFail($request->source);
            $result = $crawlService->crawl($source);
            return redirect()->route('dashboard.crawl-sources.index')
                ->with($result['success'] ? 'success' : 'error', $result['message']);
        }

        $results = $crawlService->crawlAll();
        $successCount = collect($results)->where('success', true)->count();
        $totalCount = collect($results)->sum('count');

        return redirect()->route('dashboard.crawl-sources.index')
            ->with('success', "{$successCount} स्रोतबाट {$totalCount} वटा समाचार क्रल गरियो।");
    }
}
