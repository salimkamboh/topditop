<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNotNullOnStoreIdOnReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
        });
        Schema::table('references', function (Blueprint $table) {
            $table->integer('store_id')->unsigned()->nullable(false)->change();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
        });
        Schema::table('references', function (Blueprint $table) {
            $table->integer('store_id')->unsigned()->nullable()->change();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }
}
