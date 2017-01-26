<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldGroupPanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_group_panel', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('panel_id')->unsigned()->nullable();
            $table->foreign('panel_id')->references('id')->on('panels')->onDelete('cascade');
            $table->integer('field_group_id')->unsigned()->nullable();
            $table->foreign('field_group_id')->references('id')->on('field_groups')->onDelete('cascade');
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
        //
    }
}
