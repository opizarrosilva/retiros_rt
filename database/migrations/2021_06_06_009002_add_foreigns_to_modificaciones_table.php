<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToModificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modificaciones', function (Blueprint $table) {
            $table
                ->foreign('retiro_id')
                ->references('id')
                ->on('retiros');

            $table
                ->foreign('atributo_id')
                ->references('id')
                ->on('atributos');

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
        Schema::table('modificaciones', function (Blueprint $table) {
            $table->dropForeign(['retiro_id']);
            $table->dropForeign(['atributo_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
