<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name', 150);
            $table->text('Description', 150);
            $table->string('Photo', 150);
            $table->integer('Quantity')->unsigned();
            $table->integer('Full_Price')->unsigned();
            $table->integer('Sale_Price')->nullable();
            $table->unsignedBigInteger('Category_ID');
            $table->timestamps();

            $table->foreign('Category_ID')->references('id')->on('Categorys')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Products');
    }
}
