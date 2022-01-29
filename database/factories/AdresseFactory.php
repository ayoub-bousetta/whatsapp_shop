<?php

namespace Database\Factories;

use App\Models\Adresse;
use App\Models\Adressetype;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdresseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Adresse::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'adresse'=>'Bloc 12 nb 30',
            'zip_code'=>'20600',
            'adressetype_id' => Adressetype::factory(),
            'user_id'=>User::factory(),
            'location_id'=>Location::factory()

           

        ];
    }
}
