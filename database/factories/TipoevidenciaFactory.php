<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Tipoevidencia;
use Illuminate\Database\Eloquent\Factories\Factory;

class TipoevidenciaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tipoevidencia::class;

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
