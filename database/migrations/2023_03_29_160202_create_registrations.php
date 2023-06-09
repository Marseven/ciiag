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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone_mobile');
            $table->string('phone_fixe')->nullable();
            $table->string('sexe');
            $table->string('country');
            $table->string('adherant');
            $table->string('number_adherant')->nullable();
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
        Schema::dropIfExists('registration');
    }
};
