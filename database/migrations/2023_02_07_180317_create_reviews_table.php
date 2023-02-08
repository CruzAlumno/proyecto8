<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('reviews', function (Blueprint $table) {
            // Normal Data:
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_reviwed');
            $table->string('comentario', 172);
            $table->integer('estrellas');
            $table->timestamps();
            // Foreign Key:
            $table->foreign('user_id')->references('id')->on('customers');
            $table->foreign('user_id_reviwed')->references('id')->on('customers');
            // Primary Key:
            $table->primary(['user_id', 'user_id_reviwed']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
