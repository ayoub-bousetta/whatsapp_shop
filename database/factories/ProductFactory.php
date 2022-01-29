<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->name;
        return [

            'name'=>$name,
            'slug'=>Str::slug($name),
            'category_id'=>Category::factory(),
            'unit_price'=>$this->faker->numberBetween(100,1000),
            'statuse_id'=>Status::factory(),
            'sku'=>"SKU_".$this->faker->numberBetween(100,1000),



      
        ];
    }
}
