<?php

namespace Modules\Files\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model::unguard();
      DB::table('type_files')->insert([
        [
          'name' => 'image-wysiwyg',
          'config' => '{
            "resize": [
              {
			          "name": "full",
                "width": "1024",
                "height": "780",
                "absolute": false
              },
              {
			          "name": "medium-h",
                "width": "580",
                "height": "242",
                "absolute": false
              },
              {
			          "name": "medium-s",
                "width": "449",
                "height": "242",
                "absolute": false
              },
              {
			          "name": "medium",
                "width": "345",
                "height": "240",
                "absolute": false
              }
            ],
            "maxsize": "20000",
            "ext":"jpg,png,jpeg,gif"
          }',
        ],
        [
          'name' => 'image-product',
          'config' => '{
            "resize": [
              {
			          "name": "main",
                "width": "350",
                "height": "320",
                "absolute": false
              },
              {
			          "name": "medium",
                "width": "210",
                "height": "180",
                "absolute": false
              },
              {
                "name": "small",
                "width": "100",
                "height": "100",
                "absolute": false
              }
            ],
            "maxsize": "20000",
            "ext":"jpg,jpeg,png"
          }',
        ],
        [
          'name' => 'image-type-product',
          'config' => '{
            "resize": [
              {
			          "name": "main",
                "width": "350",
                "height": "320",
                "absolute": false
              },
              {
			          "name": "medium",
                "width": "210",
                "height": "180",
                "absolute": false
              },
              {
                "name": "small",
                "width": "100",
                "height": "100",
                "absolute": false
              }
            ],
            "maxsize": "20000",
            "ext":"jpg,jpeg,png"
          }',
        ],
        [
          'name' => 'image-article',
          'config' => '{
            "resize": [
              {
			          "name": "main",
                "width": "203",
                "height": "200",
                "absolute": false
              },
              {
                "name": "small",
                "width": "150",
                "height": "148",
                "absolute": false
              },
              {
                "name": "extrasmall",
                "width": "40",
                "height": "40"
              }
            ],
            "maxsize": "20000",
            "ext":"jpg,jpeg,png"
          }',
        ],
        [
          'name' => 'image-slide',
          'config' => '{
            "resize": [
              {
			          "name": "main",
                "width": "500",
                "height": "220",
                "absolute": false
              }
            ],
            "maxsize": "20000",
            "ext":"jpg,jpeg,png"
          }',
        ],
        [
          'name' => 'file',
          'config' => '{
            "maxsize":"20000"
          }'
        ]
      ]);
    }
}
