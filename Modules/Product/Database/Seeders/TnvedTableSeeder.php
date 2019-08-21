<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Tnved;

class TnvedTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Model::unguard();

    $arrTnveds = [
      ['title' => 'Электродвигатели', 'id' => 8501510001],
      ['title' => 'Редукторы', 'id' => 8501310000],
      ['title' => 'Мотор-редукторы', 'id' => 8501310000]
    ];

    foreach ($arrTnveds as $arrTnved) {
      Tnved::create(['title' => $arrTnved['title'], 'id' => $arrTnved['id']]);
    }

  }
}
