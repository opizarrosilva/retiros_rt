<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'glosa' => $this->faker->text(255),
            'codigointerno' => $this->faker->text(255),
        ];
    }
}
