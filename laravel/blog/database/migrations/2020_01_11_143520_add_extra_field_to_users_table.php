<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('document')->nullable();
            $table->string('activo')->nullable();
            $table->string('admin')->nullable();
            $table->string('img')->nullable();
        });
        Schema::create('inmueble', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_usuario')->nullable();
            $table->string('tipo')->nullable();
            $table->string('ubicacion')->nullable();
            $table->string('precio')->nullable();
            $table->string('img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmueble');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('document');
            $table->dropColumn('activo');
            $table->dropColumn('admin');
            $table->string('img');
        });
    }
}
