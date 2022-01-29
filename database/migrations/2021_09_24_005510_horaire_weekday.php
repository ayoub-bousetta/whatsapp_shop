<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HoraireWeekday extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horaire_weekday', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekday_id')->constrained('weekdays');
            $table->foreignId('horaire_id')->constrained('horaires');   
             $table->foreignId('shop_id')->constrained('shops');   

          

          
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
        Schema::dropIfExists('horaire_weekday');

    }
}
