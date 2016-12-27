<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fields', function ($table) {
            $table->dropColumn('name');
            $table->dropColumn('values');
        });

        Schema::create('field_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');
            $table->string('values');

            $table->unique(['field_id','locale']);
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
