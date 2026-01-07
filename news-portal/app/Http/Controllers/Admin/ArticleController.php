<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles=Article::latest()->paginate(20);
        return view('admin.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
       $sources=Source::all();
       return view('admin.articles.create'.compact('sources'));

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data=$request->validate([
            'title'=>['required','string','max:255'],
            'content'=>['required','string'],
            'source_id'=>['nullable','exists:sources,id'],
        ]);
        $data['user_id']=auth()->id();
        $data['slug']=Str::slug($data['title']).'-'.Str::random(6);
        $article=Article::create($data);
        return redirect()->route('admin.articles.edit',$article)->with('status','Draft created.');

    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        return view('admin.articles.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Article $article)
    {
        //
        $data=$request->validate([
            'title'=>['required','string','max:255'],
            'content'=>['reqired','string'],
            'is_published'=>['nullable','boolean'],
            'published_at'=>['nullable','date'],
        ]);
        $article->update($data);
        return back()->with('status','Article update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
        $article->delete();
        return redirect()->route('admin.articles.index')->with('status','Article deleted');
    }
}
