<?php

namespace Database\Factories;

use App\Models\Horaire;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class HoraireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Horaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $now=Carbon::instance($this->faker->dateTimeBetween('-1 months','+1 months'));
      
        return [
            'from'=>'10:13:50',
            'to'=>'11:13:50',
        ];
    
    }
}
