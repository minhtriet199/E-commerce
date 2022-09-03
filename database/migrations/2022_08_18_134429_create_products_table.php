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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('slug',255)->unique();
            $table->text('description');
            $table->string('thumb');
            $table->longtext('content');
            $table->unsignedBigInteger('menu_id');
            $table->integer('amount');
            $table->integer('price');
            $table->integer('price_sale');
            $table->integer('active');
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menuses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
