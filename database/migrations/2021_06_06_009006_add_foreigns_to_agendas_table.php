<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table
                ->foreign('bloquehorario_id')
                ->references('id')
                ->on('bloquehorarios');

            $table
                ->foreign('retiro_id')
                ->references('id')
                ->on('retiros');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');

            $table
                ->foreign('estadoagenda_id')
                ->references('id')
                ->on('estadoagendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropForeign(['bloquehorario_id']);
            $table->dropForeign(['retiro_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['estadoagenda_id']);
        });
    }
}
