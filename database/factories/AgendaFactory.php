<?php

namespace Database\Factories;

use App\Models\Agenda;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agenda::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha' => $this->faker->date,
            'glosa' => $this->faker->text(255),
            'bloquehorario_id' => \App\Models\Bloquehorario::factory(),
            'retiro_id' => \App\Models\Retiro::factory(),
            'user_id' => \App\Models\User::factory(),
            'estadoagenda_id' => \App\Models\Estadoagenda::factory(),
        ];
    }
}
