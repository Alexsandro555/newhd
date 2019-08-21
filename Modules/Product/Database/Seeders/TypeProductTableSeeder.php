<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\TypeProduct;

class TypeProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $arrTypeProducts = [
              ['title' => 'Червячные редукторы', 'tnved_id' => 8501310000, 'product_category_id' => 2],
              ['title' => 'Планетарные редукторы','tnved_id' => 8501310000, 'product_category_id' => 2],
              ['title' => 'Коническо-цилиндрические редукторы','tnved_id' => 8501310000, 'product_category_id' => 2],
              ['title' => 'Цилиндрические редукторы','tnved_id' => 8501310000, 'product_category_id' => 2],
              ['title' => 'Червячные мотор-редукторы', 'tnved_id' => 8501310000, 'product_category_id' => 3],
              ['title' => 'Планетарные мотор-редукторы','tnved_id' => 8501310000, 'product_category_id' => 3],
              ['title' => 'Коническо-цилиндрические мотор-редукторы','tnved_id' => 8501310000, 'product_category_id' => 3],
              ['title' => 'Цилиндрические мотор-редукторы','tnved_id' => 8501310000, 'product_category_id' => 3],
              ['title' => 'Асинхронные электродвигатели','tnved_id' => 8501510001, 'product_category_id' => 1]
        ];

        foreach ($arrTypeProducts as $arrTypeProduct) {
              TypeProduct::create(['title' => $arrTypeProduct['title'], 'tnved_id' => $arrTypeProduct['tnved_id'], 'product_category_id' => $arrTypeProduct['product_category_id']]);
        }
    }
}


