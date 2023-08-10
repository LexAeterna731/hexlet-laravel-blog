<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();
        return view('article.index', compact('articles'));
    }

    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:1000'
        ]);

        $article = new Article();
        $article->fill($data);
        $article->save();

        return redirect()->route('articles.index')
            ->with('success', 'Task was successful!');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    public function update(EditArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $request->validated();
        $article->fill($data);
        $article->save();
        return redirect()->route('articles.index')
            ->with('success', 'Edit was successful!');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }
        return redirect()->route('articles.index')
            ->with('success', 'Delete was successful!');;
    }
}
