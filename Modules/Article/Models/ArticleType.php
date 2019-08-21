<?php

namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\UrlKeyTrait;
use Modules\Initializer\Traits\DefaultTrait;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Files\Entities\File;

class ArticleType extends Model
{
  use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait, UrlKeyTrait, DefaultTrait;

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
    'active' => [
      'enabled' => true
    ]
  ];

  public function articles()
  {
    return $this->hasMany(Article::class);
  }

  protected $table = 'article_types';

}
