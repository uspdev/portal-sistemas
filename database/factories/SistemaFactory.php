<?php

namespace Database\Factories;

use App\Models\Sistema;
use Illuminate\Database\Eloquent\Factories\Factory;

class SistemaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sistema::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $url = (rand(0, 100) > 90) ? '' : $this->faker->url;
        $exibir = (rand(1, 10) > 9) ? false : true;

        return [
            'nome' => 'Sistema ' . $this->faker->sentence(3),
            'url' => $url,
            'descricao' => $this->faker->text,
            'exibir' => $exibir,
        ];
    }
}
