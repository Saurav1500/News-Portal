<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::ordered()->paginate(10);
        return view('dashboard.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.pages.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Category::create($validated);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'श्रेणी सफलतापूर्वक सिर्जना गरियो।');
    }

    public function edit(Category $category)
    {
        return view('dashboard.pages.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'श्रेणी सफलतापूर्वक अद्यावधिक गरियो।');
    }

    public function destroy(Category $category)
    {
        if ($category->news()->count() > 0) {
            return redirect()->route('dashboard.categories.index')
                ->with('error', 'यस श्रेणीमा समाचारहरू छन्। पहिले तिनीहरूलाई मेटाउनुहोस्।');
        }

        if ($category->image) {
            \Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('dashboard.categories.index')
            ->with('success', 'श्रेणी सफलतापूर्वक मेटाइयो।');
    }
}
