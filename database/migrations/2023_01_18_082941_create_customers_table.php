<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('customers', function (Blueprint $table) {
            // Data:
            $table->unsignedBigInteger('user_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('city')->nullable();
            $table->string('country')->default('Spain');
            $table->string('telefono', 15);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('dni', 9)->unique();
            $table->timestamps();
            // Foreign Key:
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('customers');
    }
}
