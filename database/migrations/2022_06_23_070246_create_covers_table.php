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
        Schema::create('covers', function (Blueprint $table) {
            $table->id();
            $table->string('cover_id')->unique();
            $table->string('user_id');
            $table->string('amount')->default('300');//amount = KES 300
            $table->string('start_date');
            $table->string('end_date');
            $table->string('reference');//Payment Id or the Billing Cycle ID
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
        Schema::dropIfExists('covers');
    }
};
