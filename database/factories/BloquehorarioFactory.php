<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Bloquehorario;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloquehorarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bloquehorario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'horainicio' => $this->faker->time,
            'horafin' => $this->faker->time,
        ];
    }
}
