<?php

namespace Modules\Product\Imports;

use Modules\Product\Entities\LineProduct;
use Modules\Product\Entities\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Alexusmai\Ruslug\Slug;
use Modules\Files\Entities\ImageView;

class ProductImport implements ToModel
{
  public function model(array $row)
  {
    if($row[2]) {
      $imageView = ImageView::where('title', $row[2])->first();
    }
    $product = new Product([
      'title' => str_replace("-"," ", $row[0]),
      'price' => $row[1],
      'url_key' => \Slug::make(str_replace("/"," ",$row[0])),
      'product_category_id' => request('product_category_id'),
      'type_product_id' => request('type_product_id', null),
      'line_product_id' => request('line_product_id', null),
      'image_view_id' => $imageView?$imageView->id:null
    ]);
    return $product;
  }
}