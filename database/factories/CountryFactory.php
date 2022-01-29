<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name =$this->faker->unique->country();
        return [
            'name' =>  $name,
            'slug' => Str::slug( $name),
        ];
    }
}
