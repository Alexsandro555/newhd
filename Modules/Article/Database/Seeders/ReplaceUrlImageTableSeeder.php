<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Article\Models\Article;

class ReplaceUrlImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $articles = Article::get();
        $articles->each(function($article) {
          $article->content = str_replace("http://www.hydronix.ru/", "./storage/", $article->content);
          $article->save();
          return $article;
        });
        //

        // $this->call("OthersTableSeeder");
    }
}
