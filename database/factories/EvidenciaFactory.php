<?php

namespace Database\Factories;

use App\Models\Evidencia;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EvidenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Evidencia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->text(255),
            'retiro_id' => \App\Models\Retiro::factory(),
            'tipoevidencia_id' => \App\Models\Tipoevidencia::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
