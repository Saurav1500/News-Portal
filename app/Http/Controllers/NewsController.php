<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $totalNews = News::count();
        $publishedNews = News::published()->count();
        $draftNews = News::draft()->count();
        $recentNews = News::with('category')->latest()->take(5)->get();

        return view('dashboard.index', compact('totalNews', 'publishedNews', 'draftNews', 'recentNews'));
    }

    public function list()
    {
        $news = News::with('category')->latest()->paginate(10);
        return view('dashboard.pages.history', compact('news'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('dashboard.pages.upload_news', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'summary' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|string|max:500',
            'priority' => 'required|in:normal,high,urgent',
            'is_draft' => 'nullable|boolean',
            'terms_accepted' => 'accepted',
        ]);

        $data = $validated;
        $data['is_draft'] = $request->has('is_draft') ? true : false;
        $data['is_published'] = !$data['is_draft'];
        $data['terms_accepted'] = true;
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
            $data['image'] = $imagePath;
        }

        if (!$data['is_draft']) {
            $data['published_at'] = now();
        }

        $news = News::create($data);

        if ($request->filled('tags')) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(
                        ['slug' => Str::slug($tagName)],
                        ['name' => $tagName]
                    );
                    $tagIds[] = $tag->id;
                }
            }
            $news->tags()->sync($tagIds);
        }

        $msg = $data['is_draft'] ? 'ड्राफ्ट सफलतापूर्वक सेभ भयो।' : 'समाचार सफलतापूर्वक अपलोड भयो।';

        return redirect()->route('dashboard.news.list')->with('success', $msg);
    }

    public function edit($id)
    {
        $news = News::with('tags')->findOrFail($id);
        $categories = Category::active()->ordered()->get();
        return view('dashboard.pages.edit_news', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'summary' => 'required|string',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|string|max:500',
            'priority' => 'required|in:normal,high,urgent',
            'is_draft' => 'nullable|boolean',
        ]);

        $data = $validated;
        $data['is_draft'] = $request->has('is_draft') ? true : false;

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $imagePath = $request->file('image')->store('news_images', 'public');
            $data['image'] = $imagePath;
        }

        $news->update($data);

        if ($request->filled('tags')) {
            $tagNames = array_map('trim', explode(',', $request->tags));
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(
                        ['slug' => Str::slug($tagName)],
                        ['name' => $tagName]
                    );
                    $tagIds[] = $tag->id;
                }
            }
            $news->tags()->sync($tagIds);
        } else {
            $news->tags()->sync([]);
        }

        return redirect()->route('dashboard.news.list')->with('success', 'समाचार सफलतापूर्वक अद्यावधिक भयो।');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }
        $news->tags()->detach();
        $news->delete();

        return redirect()->route('dashboard.news.list')->with('success', 'समाचार सफलतापूर्वक मेटाइयो।');
    }

    public function toggleDraft($id)
    {
        $news = News::findOrFail($id);
        $news->update(['is_draft' => !$news->is_draft]);

        $status = $news->is_draft ? 'ड्राफ्ट' : 'प्रकाशित';
        return redirect()->route('dashboard.news.list')->with('success', "समाचारको स्थिति '{$status}' मा परिवर्तन भयो।");
    }

    public function publish($id)
    {
        $news = News::findOrFail($id);
        $news->update([
            'is_draft' => false,
            'is_published' => true,
            'published_at' => $news->published_at ?? now(),
        ]);

        return redirect()->route('dashboard.news.list')->with('success', 'समाचार सफलतापूर्वक प्रकाशित भयो।');
    }
}
