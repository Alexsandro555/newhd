<?php

namespace Modules\Slide\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Initializer\Traits\ControllerTrait;
use Modules\Slide\Entities\Slide;
use Modules\Initializer\Traits\DefaultTrait;

class SlideController extends Controller
{
  use ControllerTrait, DefaultTrait;

  public $model;

  public function __construct()
  {
    $this->model = new Slide;
  }
}
