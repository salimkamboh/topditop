<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('bond_type');
            $table->string('term_acceptance_1');
            $table->string('term_acceptance_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('bond_type');
            $table->dropColumn('term_acceptance_1');
            $table->dropColumn('term_acceptance_2');
        });
    }
}
