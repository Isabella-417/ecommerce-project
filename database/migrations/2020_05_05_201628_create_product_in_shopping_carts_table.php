<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInShoppingCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_in_shopping_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->unsigned();
            $table->integer('shopping_cart_id')->unsigned();
            $table->integer('amount')->default(1);
            $table->timestamps();
        });

        Schema::table('product_in_shopping_carts', function ($table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_in_shopping_carts');
    }
}
