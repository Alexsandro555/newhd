<?php

namespace Modules\Product\Entities;

use Illuminate\Support\Facades\Storage;
use Modules\Files\Classes\ImageHandler;
use Modules\Files\Entities\TypeFile;
use Illuminate\Http\UploadedFile;
use Modules\Files\Entities\File;

class ProductImp extends Product
{
  protected static function boot()
  {
    parent::boot(); // TODO: Change the autogenerated stub

    static::saved(function($product)
    {
      $fileNames = Storage::files('/public/source');
      $typeFile = TypeFile::where('name', 'image-product')->firstOrFail();
      foreach($fileNames as $fileName) {
        $file = new UploadedFile(storage_path('app/'.$fileName), basename($fileName));
        $imageHandler = new ImageHandler();
        $model = new File;
        $model->fileable_id = $product->id;
        $model->fileable_type = Product::class;
        $model->original_name = basename($fileName);
        $model->type_file_id = $typeFile->id;
        $model->config = $imageHandler->handling($file, $typeFile->config);
        $model->save();
      }
    });
  }
}
