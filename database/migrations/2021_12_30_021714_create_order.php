<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
           
            $table->foreignId('adresse_id');  
            $table->foreignId('method_id');  
            $table->foreignId('user_id')->constrained('users');  
            $table->foreignId('status_id');  
    
            $table->foreignId('shop_id')->constrained('shops');  
          
            $table->text('data');
        
            $table->mediumText('currency');
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
        Schema::dropIfExists('orders');
    }
}
