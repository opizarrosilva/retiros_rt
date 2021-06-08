<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToLlamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('llamados', function (Blueprint $table) {
            $table
                ->foreign('estadollamado_id')
                ->references('id')
                ->on('estadollamados');

            $table
                ->foreign('retiro_id')
                ->references('id')
                ->on('retiros');

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
        Schema::table('llamados', function (Blueprint $table) {
            $table->dropForeign(['estadollamado_id']);
            $table->dropForeign(['retiro_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
