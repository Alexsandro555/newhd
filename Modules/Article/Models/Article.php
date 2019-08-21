<?php
namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Files\Entities\File;

class Article extends Model
{
	use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait;

	protected $guarded=[];

  protected $dates = ['deleted_at','updated_at'];

  public $form = [
    'id' => [
      'enabled' => true
    ],
    'title' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ]
    ],
    'content' => [
      'enabled' => true
    ],
    'orderform' => [
      'enabled' => true
    ],
    'mainpage' => [
      'enabled' => true
    ],
    'leftmenu' => [
      'enabled' => true
    ],
    'minititle' => [
      'enabled' => true
    ],
    'active' => [
      'enabled' => true
    ],
    'article_type' => [
      'enabled' => true,
    ]
  ];

  protected $table = 'articles';

  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = strip_tags($value);
  }

  public function files()
  {
    return $this->morphMany(File::class, 'fileable');
  }

  public function article_type()
  {
    return $this->belongsTo(ArticleType::class);
  }
}
