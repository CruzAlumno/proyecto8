<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlablacarRecurridoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('blablacar_recurrido', function (Blueprint $table) {
            // Data:
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->boolean('verificado');
            // Foreign Keys:
            $table->foreign('user_id')->references('id')->on('customers');
            $table->foreign('post_id')->references('id')->on('blablacars');
            // Primary Key:
            $table->primary(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blablacar_recurrido');
    }
}
