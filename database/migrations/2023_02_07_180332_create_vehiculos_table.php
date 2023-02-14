<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('vehiculos', function (Blueprint $table) {
            // Normal Data:
            $table->unsignedBigInteger('customer_id');
            $table->enum('combustible', ['diesel', 'gasolina', 'electrico', 'hibrido'])->default('gasolina');
            $table->year('fecha_matriculacion')->nullable();
            $table->string('modelo', 48);
            $table->integer('potencia_cv')->nullable();
            $table->integer('plazas')->default(2);
            $table->integer('puertas')->nullable();
            $table->float('consumo_medio', 4, 2)->default(5);
            $table->string('matricula', 7)->unique();
            $table->timestamps();
            // Foreign Key:
            $table->foreign('customer_id')->references('id')->on('customers')->nullable();
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
        Schema::dropIfExists('vehiculos');
    }
}
