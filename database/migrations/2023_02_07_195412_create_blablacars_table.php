<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlablacarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('blablacars', function (Blueprint $table) {
            // Data:
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('titulo', 24);
            $table->string('descripcion', 224)->nullable();
            $table->string('fecha_inicio_viaje', 10);
            $table->time('hora_inicio_viaje');
            $table->string('inicio_ruta', 64);
            $table->string('destino_ruta', 64);
            $table->integer('distancia');
            $table->float('precio', 6);
            $table->float('precio_combustible', 4);
            $table->integer('plazas_disponibles');
            $table->time('estimacion_duracion')->nullable();
            $table->boolean('status_active')->default(true);
            $table->timestamps();
            // Foreign Key:
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            // Primary Key:
            $table->id();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blablacars');
    }
}
