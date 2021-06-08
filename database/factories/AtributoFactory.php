<?php

namespace Database\Factories;

use App\Models\Atributo;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AtributoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Atributo::class;

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
