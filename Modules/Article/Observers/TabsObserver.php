<?php

namespace Modules\Article\Observers;

use Modules\Article\Models\Article;

class TabsObserver
{
  private function replace($content)
  {
    $content=str_replace('<p>','',$content);
    $content=str_replace('</p>','',$content);
    $content = preg_replace ('/:selected/i',':selected="true"', $content);
    $content = preg_replace ( '/\[name="(\w+)"\s*(:selected="true")*\]/i', '<tab $2 name="$1">', $content);
    $content = preg_replace ( '/\[end\]/', '</tab>', $content);
    return $content;
  }

  private function replaceOutput($content)
  {
    $content = preg_replace( '/<tab\s+(:selected="true")*\s*name="(\w+)"\s*>/i' , '[name="$2" $1]', $content);
    $content = preg_replace( '/<\/tab>/', '[end]', $content);
    $content = preg_replace('/:selected="true"/i',':selected',$content);
    return $content;
  }

  public function creating(Article $article)
  {
    $article->url_key = \Slug::make(str_replace("/"," ",$article->title));
    $article->content = "<tab :selected=\"true\" name=\"main\"></tab><br><tab name=\"characteristics\"></tab><br><tab name=\"video\"></tab><br><tab name=\"photo\"></tab><tab name=\"download\"></tab>";
  }

  public function created(Article $article)
  {
    $article->content = $this->replaceOutput($article->content);
  }

  public function saved(Article $article)
  {
    $article->content = $this->replaceOutput($article->content);
  }


  public function saving(Article $article)
  {
    /*$article->url_key = \Slug::make(str_replace("/"," ",$article->title));
    $result = $this->replace($article->content);
    $article->content = $this->replace($article->content);*/
  }
}