<?php
namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleOtherArticle extends Model
{
  protected $guarded = [];

  public function article()
  {
    return $this->belongTo(Article::class);
  }

  public function otherArticle()
  {
    return $this->belongsTo(OtherArticle::class);
  }
}