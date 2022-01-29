<?php

namespace Database\Factories;

use App\Models\Adressetype;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdressetypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adressetype::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   

        $name =$this->faker->name();
        return [
            'name' => $this->faker->name(),
            'slug' => Str::slug( $name),
        ];
    }
}
