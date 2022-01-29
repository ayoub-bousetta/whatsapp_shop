<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('name');
            $table->string('slug')->unique();
            $table->mediumText('description');

            $table->mediumText('summary');

            $table->float('unit_price');
            $table->foreignId('shop_id')->nullable()->constrained("shops")->onDelete("cascade");  

            $table->foreignId('type_id')->nullable()->constrained('types');

            $table->foreignId('statuse_id')->nullable()->constrained('statuses');
            $table->string('sku')->nullable();



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
        Schema::dropIfExists('products');
    }
}
