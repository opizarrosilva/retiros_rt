<?php

namespace Database\Factories;

use App\Models\Bitacora;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BitacoraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bitacora::class;

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
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
