<?php

namespace Modules\Slide\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Initializer\Traits\SortTrait;
use Modules\Initializer\Traits\TableColumnsTrait;
use Modules\Initializer\Traits\UrlKeyTrait;
use Modules\Initializer\Traits\DefaultTrait;
use Modules\Initializer\Traits\RelationTrait;
use Modules\Files\Entities\File;

class Slide extends Model
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
    'url_key' => [
      'enabled' => true
    ],
    'active' => [
      'enabled' => true
    ],
    'description' => [
      'enabled' => true
    ]
  ];

  public function files()
  {
    return $this->morphMany(File::class, 'fileable');
  }

  protected $table = 'slides';
}
