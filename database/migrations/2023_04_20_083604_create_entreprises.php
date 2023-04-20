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
        Schema::create('entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('adress');
            $table->string('country');
            $table->string('gala');
            $table->string('atelier_j1_a1');
            $table->string('atelier_j1_a2');
            $table->string('atelier_j2_a1');
            $table->string('atelier_j2_a2');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entreprises');
    }
};
