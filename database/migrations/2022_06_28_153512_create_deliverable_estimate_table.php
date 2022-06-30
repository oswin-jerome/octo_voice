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
        Schema::create('deliverable_estimate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estimate_id');
            $table->unsignedBigInteger('deliverable_id');
            $table->integer('quantity')->default(1);
            $table->foreign('estimate_id')->references('id')->on('estimates');
            $table->foreign('deliverable_id')->references('id')->on('deliverables');
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
        Schema::dropIfExists('deliverable_estimate');
    }
};
