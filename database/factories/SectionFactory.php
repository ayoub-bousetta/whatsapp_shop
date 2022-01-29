<?php

namespace Database\Factories;

use App\Models\Section;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->name();
        return [
            
            'name'=>$name,
            'slug'=>Str::slug($name),
            
            'shop_id'=>Shop::factory()


         




        ];
    }
}
