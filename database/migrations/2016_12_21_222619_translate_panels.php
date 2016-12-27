<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslatePanels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('panels', function ($table) {
            $table->dropColumn('name');
        });

        Schema::create('panel_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('panel_id')->unsigned();
            $table->string('locale')->index();

            $table->string('name');

            $table->unique(['panel_id','locale']);
            $table->foreign('panel_id')->references('id')->on('panels')->onDelete('cascade');
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
