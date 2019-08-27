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
use Modules\Files\Entities\TypeFile;

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
    $articleTypes = ArticleType::whereHas('articles',function($query) {
      $query->where('leftmenu',1)->where('active',1);
    })->with(['articles' => function($query) {
      $query->with(['files' => function($query) {
        $query->where('type_file_id', TypeFile::where('name', 'image-article')->firstOrFail()->id);
      }])->where('leftmenu',1)->where('active',1)->orderBy('sort', 'asc');
    }])->where('active',1)->get();
    $otherArticles = OtherArticle::where('leftmenu',1)->get();
    return view('page::show')->with('page', Page::where('url_key', 'contacts')->firstOrFail())->with('otherArticles',$otherArticles)->with('articleTypes', $articleTypes);
  }

  public function faq()
  {
    return view('page::show')->with('page',  Page::where('url_key', 'faq')->firstOrFail());
  }
}
