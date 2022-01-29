<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('orders', function (Blueprint $table) {
        //     // $table->id();
        //     // // $table->float('subtotal');
        //     // // $table->float('total');
        //     // // $table->foreignId('billing_address_id')->constrained('adresses');  
        //     // // $table->foreignId('shipping_address_id')->constrained('adresses');  
        //     // // $table->foreignId('method_id')->constrained('methods');  
        //     // // $table->foreignId('user_id')->constrained('users');  
        //     // // $table->foreignId('status_id')->constrained('status');  
          
        //     // $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
