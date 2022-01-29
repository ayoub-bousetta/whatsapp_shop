<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->mediumText('adresse');
            $table->double('lat')->nullable();
             $table->double('lng')->nullable();
            $table->string('phone')->unique();
            $table->string('whatsapp_number');
            $table->foreignId('category_id')->nullable()->constrained();
            $table->foreignId('currency_id')->nullable()->constrained();  
            $table->foreignId('city_id')->nullable()->constrained('cities');  
            $table->foreignId('user_id')->nullable()->constrained("users")->onDelete("cascade");  
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();


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
        Schema::dropIfExists('shops');
    }
}
