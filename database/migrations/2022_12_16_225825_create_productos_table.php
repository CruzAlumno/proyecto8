<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Script Creacion Tablas en la Base de Datos:
class CreateProductosTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('productos', function (Blueprint $table) {
            // Primary Key:
            $table->id();
            // Foreign Key Constrain:
            $table->bigInteger('vehiculo_id')->unsigned()->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            // Normal Data:
            $table->string('titulo', 24);
            $table->string('descripcion', 300);
            $table->string('inicio_ruta', 64);
            $table->string('destino_ruta', 64);
            $table->string('fecha_inicio_viaje'); // Date Daba Problemas con el Formato del input date HTML.
            $table->time('hora_inicio_viaje');
            $table->dateTime('estimacion_llegada')->nullable();
            $table->float('distancia', 8, 2)->default(0);
            $table->float('precio', 8, 2)->default(0);
            $table->boolean('status_active')->default(true);
            $table->boolean('allow_desvios')->default(false);
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
        Schema::dropIfExists('productos');
        // Drop FK:
        Schema::table('productos', function(Blueprint $table) {
            $table->dropForeign('vehiculos_vehiculo_id_foreign');
            $table->dropColumn('vehiculo_id');
        });
    }
}
