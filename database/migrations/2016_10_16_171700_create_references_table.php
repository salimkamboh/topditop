<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->increments("id");
            $table->string("title");
            $table->boolean("status");
            $table->string('description');
            $table->string('video');
            $table->timestamps();
        });
//        Schema::create('references_translations', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('article_id')->unsigned();
//            $table->string('locale')->index();
//
//            $table->string('name');
//            $table->text('text');
//
//            $table->unique(['article_id', 'locale']);
//            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('references');
    }
}
