<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslateFieldProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field_profile', function ($table) {
            $table->dropColumn('selected');
        });

        Schema::create('field_profile_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_profile_id')->unsigned();
            $table->string('locale')->index();

            $table->longText('selected');

            $table->unique(['field_profile_id','locale']);
            $table->foreign('field_profile_id')->references('id')->on('field_profile')->onDelete('cascade');
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
