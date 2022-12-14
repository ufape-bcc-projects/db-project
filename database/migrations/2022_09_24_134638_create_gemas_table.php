<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedDouble('peso');
            $table->unsignedDouble('altura');
            $table->unsignedDouble('diametro');
            $table->unsignedDouble('indice');
            $table->unsignedInteger('ph');
            $table->unsignedInteger('cor');
            $table->unsignedBigInteger('id_ovo');
            $table->timestamps();

            $table->foreign('id_ovo')->references('id')->on('ovos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gemas');
    }
};
