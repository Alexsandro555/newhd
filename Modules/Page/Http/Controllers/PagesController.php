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

  public function articleTypes()
  {
    return $articleTypes = ArticleType::whereHas('articles',function($query) {
      $query->where('leftmenu',1)->where('active',1);
    })->with(['articles' => function($query) {
      $query->with(['files' => function($query) {
        $query->where('type_file_id', TypeFile::where('name', 'image-article')->firstOrFail()->id);
      }])->where('leftmenu',1)->where('active',1)->orderBy('sort', 'asc');
    }])->where('active',1)->get();
  }

  public function otherArticles()
  {
    return $otherArticles = OtherArticle::where('leftmenu',1)->get();
  }

  public function contracts()
  {

    return view('page::show')->with('page', Page::where('url_key', 'contacts')->firstOrFail())->with('otherArticles',$this->otherArticles())->with('articleTypes', $this->articleTypes());
  }

  public function faq()
  {
    return view('page::show')->with('page',  Page::where('url_key', 'faq')->firstOrFail())->with('articleTypes', $this->articleTypes())->with('otherArticles', $this->otherArticles());
  }
}
