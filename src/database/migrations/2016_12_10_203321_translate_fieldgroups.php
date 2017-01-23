<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslateFieldgroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field_groups', function ($table) {
            $table->dropColumn('name');
        });

        Schema::create('field_group_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_group_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');

            $table->unique(['field_group_id','locale']);
            $table->foreign('field_group_id')->references('id')->on('field_groups')->onDelete('cascade');
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
