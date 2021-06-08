<?php

namespace Database\Factories;

use App\Models\Llamado;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LlamadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Llamado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'estadollamado_id' => \App\Models\Estadollamado::factory(),
            'retiro_id' => \App\Models\Retiro::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
