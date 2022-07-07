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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_method', ['cash', 'card', 'cheque', 'other']);
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default("paid");
            $table->double('amount');
            $table->string('reference');
            $table->string("description");
            $table->string("payment_type")->default("incoming"); //incoming or out going

            $table->string('paymentable_id');
            $table->string('paymentable_type');

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
};
