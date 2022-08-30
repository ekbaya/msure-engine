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
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('CheckoutRequestID', 'reference');
            $table->renameColumn('Amount', 'amount');
            $table->renameColumn('PhoneNumber', 'phone');
            $table->renameColumn('PolicyGuid', 'policy_guid');
            $table->renameColumn('TransactionDate', 'transaction_date');
            $table->renameColumn('MpesaReceiptNumber', 'transaction_id');
            $table->renameColumn('Status', 'status');
            $table->dropColumn('MerchantRequestID');
            $table->dropColumn('ResponseCode');
            $table->dropColumn('ResponseDescription');
            $table->dropColumn('CustomerMessage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->renameColumn('CheckoutRequestID', 'reference');
            $table->renameColumn('Amount', 'amount');
            $table->renameColumn('PhoneNumber', 'phone');
            $table->renameColumn('PolicyGuid', 'policy_guid');
            $table->renameColumn('TransactionDate', 'transaction_date');
            $table->renameColumn('MpesaReceiptNumber', 'transaction_id');
            $table->renameColumn('Status', 'status');
            $table->dropColumn('MerchantRequestID');
            $table->dropColumn('ResponseCode');
            $table->dropColumn('ResponseDescription');
            $table->dropColumn('CustomerMessage');
        });
    }
};
