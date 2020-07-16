<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_warehouse', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('article_sellpoint', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned();
            $table->unsignedBigInteger('sellpoint_id')->nullable();
            $table->foreign('sellpoint_id')->references('id')->on('sellpoints')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('article_sellpoint_warehouses', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->unsigned();
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('sellpoint_id')->nullable();
            $table->foreign('sellpoint_id')->references('id')->on('sellpoints')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('article_warehouse');
        Schema::dropIfExists('article_sellpoint');
        Schema::dropIfExists('article_sellpoint_warehouses');
    }
}
