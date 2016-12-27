<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLimitationPackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('limitation_package', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id')->unsigned()->nullable();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->integer('limitation_id')->unsigned()->nullable();
            $table->foreign('limitation_id')->references('id')->on('limitations')->onDelete('cascade');
            $table->longText('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('limitation_package');
    }
}
