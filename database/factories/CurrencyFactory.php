<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurrencyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Currency::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   

        $name =$this->faker->unique()->name();
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'code'=>$this->faker->unique()->currencyCode(),
            'symbole'=>$this->faker->unique()->currencyCode(2),
        ];
    }
}
