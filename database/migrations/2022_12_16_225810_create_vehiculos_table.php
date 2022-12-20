<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Script Creacion Tablas en la Base de Datos:
class CreateVehiculosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vehiculos', function (Blueprint $table) {
            // Primary Key:
            $table->id();
            // Foreign Key Constrain:
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('usuario_perfiles');
            // Normal Data:
            $table->string('matricula', 7)->unique();
            $table->string('combustible', 12);
            $table->text('modelo');
            $table->integer('potencia_cv');
            $table->float('motor', 3, 2);
            $table->integer('plazas')->default(3);
            $table->date('matriculacion_fecha');
            // Default Creation TimeStamps:
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('vehiculos');
        // Drop FK:
        Schema::table('vehiculos', function(Blueprint $table) {
            $table->dropForeign('usuario_perfiles_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
