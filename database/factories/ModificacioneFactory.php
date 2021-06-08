<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Modificacione;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModificacioneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Modificacione::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'glosa' => $this->faker->text(255),
            'retiro_id' => \App\Models\Retiro::factory(),
            'atributo_id' => \App\Models\Atributo::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
