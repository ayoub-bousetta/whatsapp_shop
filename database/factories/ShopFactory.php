<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Currency;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $name=$this->faker->name();
        return [
            
            'ame'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->text(),
            'adresse'=>$this->faker->name(),
            'lat'=>34.0181246,
            'lng'=>-5.0078451,
            'phone'=>$this->faker->e164PhoneNumber(),
            'whatsapp_number'=>$this->faker->e164PhoneNumber(),
            'currency_id'=>Currency::factory(),
            'city_id'=>City::factory() ,
            'user_id'=>Auth::id(),


         




        ];
    }
}
