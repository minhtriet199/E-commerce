<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('orders',function (Blueprint $table){
            $table->unsignedBigInteger('city')->nullable();
            $table->unsignedBigInteger('district')->nullable();
            $table->foreign('city')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');;
            $table->foreign('district')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');;
        });
    }

    public function down()
    {
        //
    }
};
