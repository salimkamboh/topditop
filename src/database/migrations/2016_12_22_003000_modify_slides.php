<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySlides extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slides', function ($table) {
            $table->dropColumn('content');
            $table->dropColumn('valid_until');
            $table->dropForeign('slides_store_id_foreign');
            $table->dropColumn('store_id');
            $table->string('slot1_store_id');
            $table->string('slot1_width');
            $table->string('slot1_valid_until');
            $table->string('slot2_store_id');
            $table->string('slot2_width');
            $table->string('slot2_valid_until');
            $table->string('slot3_store_id');
            $table->string('slot3_width');
            $table->string('slot3_valid_until');
            $table->string('slot4_store_id');
            $table->string('slot4_width');
            $table->string('slot4_valid_until');
            $table->string('slot5_store_id');
            $table->string('slot5_width');
            $table->string('slot5_valid_until');
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
