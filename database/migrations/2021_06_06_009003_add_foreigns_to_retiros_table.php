<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToRetirosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retiros', function (Blueprint $table) {
            $table
                ->foreign('cliente_id')
                ->references('id')
                ->on('clientes');

            $table
                ->foreign('estadoretiro_id')
                ->references('id')
                ->on('estadoretiros');

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
        Schema::table('retiros', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);
            $table->dropForeign(['estadoretiro_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
