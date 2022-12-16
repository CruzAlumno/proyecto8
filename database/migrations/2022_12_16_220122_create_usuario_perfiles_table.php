<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// Script Creacion Tablas en la Base de Datos:
class CreateUsuarioPerfilesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('usuario_perfiles', function (Blueprint $table) {
            // Primary Key:
            $table->id();
            // Normal Data:
            $table->string('nombre', 48);
            $table->string('apellidos', 48);
            $table->string('telefono', 12)->nullable();
            $table->string('IBAN', 34)->nullable()->unique();
            $table->string('link_imagen_perfil', 64)->nullable();
            $table->integer('estrellas')->default(0);
            $table->date('fecha_nacimiento');
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
        Schema::dropIfExists('usuario_perfiles');
    }
}
