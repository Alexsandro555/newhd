<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Article\Models\Article;
use Modules\Article\Models\ArticleType;
use Modules\Article\Models\OtherArticle;
use Modules\Page\Models\Page;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class PagesController extends Controller
{
	Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
      $this->model=new Page;
  }

  public function show($slug)
  {
    $page = Page::where('url_key', $slug)->firstOrFail();
    return view('page::show', compact('page'));
  }

  public function contracts()
  {
    $vlagas = Article::where('article_type_id',ArticleType::where('title', 'Микроволновые датчики (влагомеры)')->firstOrFails()->id)->where('leftmenu',1)->get();
    $interfs = Article::where('article_type_id',ArticleType::where('title', 'Температура')->andWhere('title','Интерфейсные модули')->firstOrFails()->id)->where('leftmenu',1)->get();
    $otherArticles = OtherArticle::where('leftmenu',1)->get();
    return view('page::show')->with('page', Page::where('url_key', 'contacts')->firstOrFail());
  }

  public function faq()
  {
    return view('page::show')->with('page',  Page::where('url_key', 'faq')->firstOrFail());
  }
}
