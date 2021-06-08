<?php

namespace Database\Factories;

use App\Models\Retiro;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RetiroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Retiro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'glosa' => $this->faker->text,
            'fechacarga' => $this->faker->dateTime,
            'cliente_id' => \App\Models\Cliente::factory(),
            'estadoretiro_id' => \App\Models\Estadoretiro::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
