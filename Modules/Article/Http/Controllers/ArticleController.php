<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Models\Article;
use Modules\Files\Entities\TypeFile;
use Modules\Article\Models\OtherArticle;

class ArticleController extends Controller
{
  public function list() {
    $articles = Article::with('files')->get();
    return view('article::index', compact('articles'));
  }

  public function show($slug) {
    $article = OtherArticle::where('url_key', $slug)->first();
    $relatedArticles = collect();
    if($article) return view('article::show', compact('article', 'relatedArticles'));

    $article = Article::where('url_key', $slug)->firstOrFail();
    if(!$article->active) {
      return redirect()->route('main');
    }
    $relatedArticles = Article::with(['files' => function($query) {
      $query->where('type_file_id', TypeFile::where('name', 'image-article')->first()->id);
    }])->where('article_type_id', $article->article_type_id)->where('active',1)->get();
    return view('article::show', compact('article', 'relatedArticles'));
  }

  public function faq()
  {
    return abort();
  }
}
