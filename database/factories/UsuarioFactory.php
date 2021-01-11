<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NmUsuario' => $this->faker->word,
        'Email' => $this->faker->word,
        'Login' => $this->faker->word,
        'Senha' => $this->faker->word,
        'DtNascimento' => $this->faker->word,
        'Avaliacao' => $this->faker->word,
        'Descricao' => $this->faker->word,
        'Foto' => $this->faker->word,
        'CdInstituicao' => $this->faker->randomDigitNotNull
        ];
    }
}
