<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
//use Modules\Article\Entities\Article;
use Modules\Product\Entities\ProductCategory;
use Modules\Product\Entities\TypeProduct;
use Modules\Product\Entities\LineProduct;
use Modules\News\Entities\News;
use Modules\Product\Entities\AttributeGroup;
use Modules\Product\Entities\Attribute;
use Modules\Article\Models\ArticleType;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Modules\Slide\Entities\Slide;
use Modules\Files\Entities\TypeFile;
use Modules\Article\Models\OtherArticle;
use Modules\Callback\Models\Callback;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
  public function index()
  {
    $articleTypes = ArticleType::whereHas('articles',function($query) {
      $query->where('mainpage',1)->where('active',1);
    })->with(['articles' => function($query) {
      $query->with(['files' => function($query) {
        $query->where('type_file_id', TypeFile::where('name', 'image-article')->first()->id);
      }])->where('mainpage',1)->where('active',1)->orderBy('sort', 'asc');
    }])->where('active',1)->get();
    $otherArticles = OtherArticle::with(['files' => function($query) {
        $query->where('type_file_id', TypeFile::where('name', 'image-article')->first()->id);
    }])->where('mainpage',1)->where('active',1)->orderBy('sort', 'asc')->get();
    return view('index')->with('articleTypes', $articleTypes)->with('otherArticles', $otherArticles);
  }

  public function catalog($slug)
  {
    $model = ProductCategory::with(['typeProducts' => function ($query) {
      $query->where('active', 1);
    }])->where('url_key', $slug)->first();
    /*$products = Product::with(['files', 'lineProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'typeProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'productCategory.files' => function($query) {
      $query->doesntHave('figure');
    }])->where('product_category_id', $model->id)->where('active',1)->paginate(30);*/
    return view('catalog', compact('model'));
  }

  public function typeProduct($slugProductCategory, $slug)
  {
    $model = TypeProduct::with(['lineProducts' => function($query) {
      $query->where('active',1);
    }])->where('url_key', $slug)->first();

    /*$products = Product::with(['files', 'lineProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'typeProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'productCategory.files' => function($query) {
      $query->doesntHave('figure');
    }])->where('type_product_id', $model->id)->paginate(30);*/
    return view('catalog', compact('model'));
  }

  public function lineProduct($slugProductCategory, $slugTypeProduct, $slug)
  {
    $model = LineProduct::where('url_key', $slug)->firstOrFail();
    $products = Product::with(['files', 'lineProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'typeProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'productCategory.files' => function($query) {
      $query->doesntHave('figure');
    },'attributes' => function($query) {
      $query->where('filtered',1)->where('active',1);
    }])->where('line_product_id', $model->id)->where('active',1)->get();
    $attributes = Attribute::whereHas('lineProducts', function($query) use ($model) {
      $query->where('id', $model->id);
    })->orWhereHas('typeProducts', function($query) use ($model) {
      $query->where('id', $model->type_product->id);
    })->orWhereHas('productCategories', function($query) use ($model) {
      $query->where('id', $model->type_product->product_category->id);
    })->with(['attributeListValue'])->where('attribute_type_id', 8)->where('filtered', 1)->where('active',1)->get();
    return view('lineProduct', compact('model','products', 'attributes'));
  }

  public function equipment()
  {
    $products = Product::andFiles()->with(['attributes' => function($query) {
      $query->where('filtered',1)->where('active',1);
    }])->where('special', 1)->where('active',1)->get();
    return view('equipment',compact('products'));
  }

  public function menuLeft()
  {
    return ProductCategory::with(['typeProducts' => function($query) {
      $query->orderBy('sort');
    }, 'typeProducts.lineProducts' => function($query) {
      $query->orderBy('sort');
    }])->get();
  }

  public function detail($slug)
  {
    $groups = AttributeGroup::orderBy('sort', 'asc')->get();
    $product = Product::with(['files', 'attributes.attributeListValue'])->where('url_key',$slug)->first();
    return view('detail', compact('product', 'groups'));
  }

  public function products()
  {
    $products = Product::with(['attributes' => function($query) {
      $query->where('attribute_type_id', 8);
    },'files', 'lineProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'typeProduct.files' => function($query) {
      $query->doesntHave('figure');
    }, 'productCategory.files' => function($query) {
      $query->doesntHave('figure');
    }])->where('product_category_id', 2)->get();
    $attributes = Attribute::with(['attributeListValue'])->where('attribute_type_id', 8)->where('filtered', 1)->get();
    return view('test', compact('products', 'attributes'));
  }

  public function slides()
  {
    return Slide::with('files')->where('active',1)->get()->each(function($slide) {
      $slide->description = strip_tags($slide->description);
      return $slide;
    });
  }

  public function callback(Request $request)
  {
    $model = Callback::create([
      'name' => $request->fio,
      'company_name' => $request->company,
      'telephone' => $request->tel,
      'email' => $request->email,
      'comment' => $request->description
    ]);
    Mail::to("xanmaster08@rambler.ru")->send(new CallbackShipped($model));
    return view('callback::sucessfull');
  }
}
