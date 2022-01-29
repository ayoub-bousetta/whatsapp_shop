<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Mediazone;
use App\Models\Section;
use App\Models\Status;
use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          Country::factory(8)->create();
          Currency::factory(5)->create();
          Mediazone::factory(10)->create();
         Category::factory(10)->create();
         Status::factory(10)->create();
         City::factory(10)->create();
         Type::factory(10)->create();
         Section::factory(10)->create();


        
    }
}
