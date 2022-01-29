<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSeoToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
           
            $table->boolean('online')->nullable()->default(0);
            $table->mediumText('seo_description')->nullable();
            $table->foreignId('section_id')->nullable()->constrained('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('online');
            $table->dropColumn('seo_description');
            $table->dropColumn('section_id');

        });
    }
}
