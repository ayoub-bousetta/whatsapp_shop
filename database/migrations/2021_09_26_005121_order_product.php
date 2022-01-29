<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('order_product', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('product_id')->constrained('products');
        //     $table->integer('quantity');
        //      $table->float('unit_price');
          

          
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
        *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');

    }
}
