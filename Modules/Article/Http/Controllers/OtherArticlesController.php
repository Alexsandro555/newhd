<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Article\Models\OtherArticle;
use Modules\Initializer\Traits\DefaultTrait;
use Modules\Initializer\Traits\ControllerTrait;


class OtherArticlesController extends Controller
{
  Use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new OtherArticle;
  }
}
