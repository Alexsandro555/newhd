<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleOtherArticleTable extends Migration
{
  private $tableName = 'article_other_articles';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id');
      $table->integer('article_id')->length(11)->unsigned();
      $table->integer('other_article_id')->length(11)->unsigned();
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
      $table->foreign('other_article_id')->references('id')->on('other_articles')->onDelete('cascade');
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('article_other_article_article_id_foreign');
      $table->dropForeign('article_other_article_other_article_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
