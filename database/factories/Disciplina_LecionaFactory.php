<?php

namespace Database\Factories;

use App\Models\Disciplina_Leciona;
use Illuminate\Database\Eloquent\Factories\Factory;

class Disciplina_LecionaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Disciplina_Leciona::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'CdDisciplina' => $this->faker->randomDigitNotNull,
        'CdUsuario_Professor' => $this->faker->randomDigitNotNull
        ];
    }
}
