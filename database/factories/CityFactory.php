<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name =$this->faker->city();
        return [
            'name' =>  $name,
            'slug' => Str::slug( $name),
            'country_id'=>Country::factory()
           
        ];
    }
}
