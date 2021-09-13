<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grupo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $descricao = (rand(1,10)>8) ? $this->faker->text : ''; 

        return [
            'nome' => $this->faker->word,
            'coluna' => rand(1,3),
            'descricao' => $descricao,
            //
        ];
    }
}
