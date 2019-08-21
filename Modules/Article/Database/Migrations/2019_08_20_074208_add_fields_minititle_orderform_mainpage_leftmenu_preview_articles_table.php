<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsMinititleOrderformMainpageLeftmenuPreviewArticlesTable extends Migration
{
  private $tableName = 'articles';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->string('minititle', 255)->nullable()->comment('Сокращенный заголовок');
      $table->boolean('orderform')->nullable()->comment('Отображать форму заказа');
      $table->boolean('mainpage')->nullable()->comment('Отображать на главной странице');
      $table->boolean('leftmenu')->nullable()->comment('Отображать в левом меню');
      $table->text('preview')->nullable()->comment('Превью');
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
      $table->dropColumn('preview');
      $table->dropColumn('leftmenu');
      $table->dropColumn('mainpage');
      $table->dropColumn('orderform');
      $table->dropColumn('minititle');
    });
  }
}
