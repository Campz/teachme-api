<?php

namespace Database\Factories;

use App\Models\Anuncio;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnuncioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anuncio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'QtdAlunos' => $this->faker->randomDigitNotNull,
        'Descricao' => $this->faker->word,
        'CdDisciplina' => $this->faker->randomDigitNotNull,
        'CdUsuario_Professor' => $this->faker->randomDigitNotNull,
        'Valor' => $this->faker->word
        ];
    }
}
