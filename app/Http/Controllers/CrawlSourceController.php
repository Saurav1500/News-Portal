<?php

namespace App\Http\Controllers;

use App\Models\CrawlSource;
use App\Models\Category;
use Illuminate\Http\Request;

class CrawlSourceController extends Controller
{
    public function index()
    {
        $sources = CrawlSource::with('category')->latest()->paginate(10);
        return view('dashboard.pages.crawl-sources.index', compact('sources'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('dashboard.pages.crawl-sources.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'category_id' => 'nullable|exists:categories,id',
            'crawl_interval_minutes' => 'nullable|integer|min:5',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        CrawlSource::create($validated);

        return redirect()->route('dashboard.crawl-sources.index')
            ->with('success', 'क्रल स्रोत सफलतापूर्वक सिर्जना गरियो।');
    }

    public function edit(CrawlSource $crawlSource)
    {
        $categories = Category::active()->ordered()->get();
        return view('dashboard.pages.crawl-sources.edit', compact('crawlSource', 'categories'));
    }

    public function update(Request $request, CrawlSource $crawlSource)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:500',
            'category_id' => 'nullable|exists:categories,id',
            'crawl_interval_minutes' => 'nullable|integer|min:5',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $crawlSource->update($validated);

        return redirect()->route('dashboard.crawl-sources.index')
            ->with('success', 'क्रल स्रोत सफलतापूर्वक अद्यावधिक गरियो।');
    }

    public function destroy(CrawlSource $crawlSource)
    {
        $crawlSource->delete();

        return redirect()->route('dashboard.crawl-sources.index')
            ->with('success', 'क्रल स्रोत सफलतापूर्वक मेटाइयो।');
    }
}
