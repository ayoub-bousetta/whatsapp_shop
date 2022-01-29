<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name =$this->faker->unique->name();
        return [
            'name' =>  $name,
            'slug' => Str::slug( $name),
        ];
    }
}
