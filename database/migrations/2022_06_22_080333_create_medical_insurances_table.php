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
        Schema::create('medical_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->unique();
            $table->string('user_id');
            $table->string('amount')->default('30');//amount = KES 30
            $table->string('date');
            $table->string('reference');//calculating Period Account Id or Payment ID
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
        Schema::dropIfExists('medical_insurances');
    }
};
