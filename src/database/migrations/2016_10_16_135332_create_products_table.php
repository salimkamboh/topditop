<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments("id");
            $table->string("title");
            $table->longText("description")->nullable();
            $table->string('SKU')->nullable();
            $table->string('category_ids')->nullable();
            $table->string('short_description')->nullable();
            $table->string('weight')->nullable();
            $table->string('news_from_date')->nullable();
            $table->string('news_to_date')->nullable();
            $table->string('country_of_manufacture')->nullable();
            $table->string('price')->nullable();
            $table->string('url_key')->nullable();
            $table->string('mag_product_id')->nullable();
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
        Schema::drop('products');
    }
}
