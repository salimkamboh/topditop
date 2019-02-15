<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThumbnailColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brandreferences', function (Blueprint $table) {
            $table->dropColumn('thumbnail_url');
            $table->string('thumbnail_small_url');
            $table->string('thumbnail_medium_url');
            $table->string('thumbnail_large_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brandreferences', function (Blueprint $table) {
            $table->string('thumbnail_url');
            $table->dropColumn('thumbnail_small_url');
            $table->dropColumn('thumbnail_medium_url');
            $table->dropColumn('thumbnail_large_url');
        });
    }
}
