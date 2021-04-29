<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('customer', function (Blueprint $table) {
            $table->id();
            $table->integer('MSKH');
            $table->string('HoTenKH');
            $table->string('Email')->unique();
            $table->string('SoDienThoai');
            $table->string('DiaChi');
            $table->string('password');
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
        //
        Schema::dropIfExists('customer');
    }
}
