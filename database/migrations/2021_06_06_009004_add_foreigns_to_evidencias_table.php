<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToEvidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evidencias', function (Blueprint $table) {
            $table
                ->foreign('retiro_id')
                ->references('id')
                ->on('retiros');

            $table
                ->foreign('tipoevidencia_id')
                ->references('id')
                ->on('tipoevidencias');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evidencias', function (Blueprint $table) {
            $table->dropForeign(['retiro_id']);
            $table->dropForeign(['tipoevidencia_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
