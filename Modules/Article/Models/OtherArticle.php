<?php

namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Files\Entities\File;

class OtherArticle extends Model
{
  use SoftDeletes, RelationTrait, TableColumnsTrait, SortTrait;

  protected $guarded=[];

  protected $dates = ['deleted_at','updated_at'];

  public $form = [
    'id' => [
      'enabled' => true,
      'sort' => 1
    ],
    'title' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ],
      'sort' => 2
    ],
    'short_title' => [
      'enabled' => true,
      'validations' => [
        'max' => 255
      ],
      'sort' => 3
    ],
    'minititle' => [
      'enabled' => true,
      'sort' => 4
    ],
    'url_key' => [
      'enabled' => true,
      'validations' => [
        'required' => true,
        'max' => 255
      ],
      'sort' => 5
    ],
    'content' => [
      'enabled' => true,
      'sort' => 6
    ],
    'orderform' => [
      'enabled' => true,
      'sort' => 7
    ],
    'mainpage' => [
      'enabled' => true,
      'sort' => 8
    ],
    'leftmenu' => [
      'enabled' => true,
      'sort' => 9
    ],
    'active' => [
      'enabled' => true,
      'sort' => 10
    ]
  ];

  protected $table = 'other_articles';

  public function files()
  {
    return $this->morphMany(File::class, 'fileable');
  }
}
