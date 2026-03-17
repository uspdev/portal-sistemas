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
        $descricao = (rand(1, 10) > 8) ? $this->faker->text : '';
        $exibir = (rand(1, 10) > 9) ? false : true;

        $num_cols = config('portal-sistemas.num_cols', 3);
        $coluna = (rand(1, 10) > 8) ? ($num_cols + 1) : rand(1, $num_cols);

        return [
            'nome' => $this->faker->word,
            'coluna' => $coluna,
            'descricao' => $descricao,
            'exibir' => $exibir,
        ];
    }
}
