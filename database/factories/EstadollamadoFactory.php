<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Estadollamado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadollamadoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estadollamado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'glosa' => $this->faker->text(255),
        ];
    }
}
