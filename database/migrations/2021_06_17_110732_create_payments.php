<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->text('description');
            $table->double('amount')->nullable();
            $table->integer('status');
            $table->string('time_out');
            $table->text('billing_id')->nullable();
            $table->text('operator')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('paid_at')->nullable();
            $table->string('expired_at')->nullable();
            $table->integer('registration_id')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
