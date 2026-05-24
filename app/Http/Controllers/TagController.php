<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('news')->orderBy('name')->paginate(20);
        return view('dashboard.pages.tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('dashboard.tags.index')
            ->with('success', 'ट्याग सफलतापूर्वक सिर्जना गरियो।');
    }

    public function update(Request $request, Tag $tag)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id,
        ]);

        $tag->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);

        return redirect()->route('dashboard.tags.index')
            ->with('success', 'ट्याग सफलतापूर्वक अद्यावधिक गरियो।');
    }

    public function destroy(Tag $tag)
    {
        $tag->news()->detach();
        $tag->delete();

        return redirect()->route('dashboard.tags.index')
            ->with('success', 'ट्याग सफलतापूर्वक मेटाइयो।');
    }
}
