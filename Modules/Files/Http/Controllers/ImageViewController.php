<?php

namespace Modules\Files\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Files\Entities\ImageView;

class ImageViewController extends Controller
{
  Use ControllerTrait;

  public $model;

  public function __construct()
  {
    $this->model = new ImageView;
  }
}
