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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('phone')->unique();
            $table->string('user_id');
            $table->string('name');
            $table->string('surname');
            $table->string('display_language')->default('en');
            $table->string('national_id');
            $table->string('beneficiary_phone');
            $table->string('beneficiary_name');
            $table->string('date_of_birth');
            $table->string('registration_channel')->default('ApiClient');
            $table->string('location');
            $table->string('ntsa_number');
            $table->string('branch_code')->nullable();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('guid')->nullable();//ASIN ENGINE GUID. Will be filled on update
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
