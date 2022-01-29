<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class PlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        $name = $this->faker->name();
        return [
            'name'=> $name,
            'slug'=>Str::slug( $name),
            'description'=>$this->faker->paragraph(),
            'features'=>$this->faker->paragraph(),
            'price'=>$this->faker->numberBetween(10,1000),
            'orders_limit'=>$this->faker->numberBetween(10,1000),
            
        ];
    }
}
