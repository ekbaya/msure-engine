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
        Schema::create('billing_cycle_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_id')->unique();
            $table->string('user_id');
            $table->string('amount');//min KES 0 maximum KES 326
            $table->string('status')->default('active');//active or closed
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
        Schema::dropIfExists('billing_cycle_accounts');
    }
};
