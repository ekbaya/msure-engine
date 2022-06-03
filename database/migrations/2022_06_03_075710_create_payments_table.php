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
            $table->timestamps();
            $table->string('MerchantRequestID');
            $table->string('CheckoutRequestID');
            $table->string('ResponseCode');
            $table->string('ResponseDescription');
            $table->string('CustomerMessage');
            $table->string('Amount');
            $table->string('PhoneNumber');
            $table->string('PolicyGuid');
            $table->string('TransactionDate')->nullable();
            $table->string('MpesaReceiptNumber')->nullable();
            $table->string('Status')->default('unpaid');
            $table->string('UserId');
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
