<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Estadoretiro;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoretiroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estadoretiro::class;

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
