<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use App\Models\Weekday;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeekdayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Weekday::class;

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
