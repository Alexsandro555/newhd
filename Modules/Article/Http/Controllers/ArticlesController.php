<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Article\Models\Article;
use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Initializer\Traits\DefaultTrait;

class ArticlesController extends Controller
{
	Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
      $this->model=new Article;
  }

  private function replace($content)
  {
    $content=str_replace('<div>','',$content);
    $content=str_replace('</div>','',$content);
    $content = preg_replace ('/:selected/i',':selected="true"', $content);
    $content = preg_replace ( '/\[name="(\w+)"\s*(:selected="true")*\]/i', '<tab $2 name="$1">', $content);
    $content = preg_replace ( '/\[end\]/', '</tab>', $content);
    return $content;
  }

  public function index(Request $request)
  {
    $articles = $this->model->get();
    $articles->each(function($article) {
      $content = $article->content;
      $content = preg_replace( '/<tab\s+(:selected="true")*\s*name="(\w+)"\s*>/i' , '[name="$2" $1]', $content);
      $content = preg_replace( '/<\/tab>/', '[end]', $content);
      $content = preg_replace('/:selected="true"/i',':selected',$content);
      $article->content = $content;
    });
    return $articles;
  }

  public function save(Request $request)
  {
    $article = Article::findOrFail($request->id);
    $article->fill($request->all());
    //$article->url_key = \Slug::make(str_replace("/"," ",$article->title));
    $content = $article->content;
    $article->content = $this->replace($content);
    $article->save();
    return $article;
  }
}
