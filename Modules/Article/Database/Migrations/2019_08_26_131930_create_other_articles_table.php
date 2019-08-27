<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherArticlesTable extends Migration
{
  private $tableName = 'other_articles';
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Идентефикатор');
      $table->string('title')->nullable()->comment('Наименование');
      $table->string('minititle', 255)->nullable()->comment('Сокращенное наименование на главной странице');
      $table->boolean('orderform')->nullable()->comment('Отображать форму заказа');
      $table->boolean('mainpage')->nullable()->comment('Отображать на главной странице');
      $table->boolean('leftmenu')->nullable()->comment('Отображать в левом меню');
      $table->text('preview')->nullable()->comment('Превью');
      $table->string('url_key', 255)->nullable()->comment('Url');
      $table->text('content')->nullable()->comment('Содержимое');
      $table->unsignedInteger('sort')->nullable()->comment('Сорт.');
      $table->boolean('active')->default(true)->comment('Актив.');
      $table->smallInteger('flex_point')->default(1);
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Отрасли применения'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists($this->tableName);
  }
}
