<?php

namespace App\Http\Controllers;

use Modules\Product\Entities\Product;

class TestController extends Controller
{
    public function test()
    {
      return view('index')->with('articleTypes', ArticleType::with('articles')->get());
    }
}
