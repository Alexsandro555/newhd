<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Article\Models\ArticleOtherArticle;
use Modules\Initializer\Traits\ControllerTrait;
use Illuminate\Http\Request;

class ArticleOtherArticleController extends Controller
{
  Use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new ArticleOtherArticle;
  }
}
