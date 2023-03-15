<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'foto' => $this->faker->image('public/assets/images',100,100),
            'nome' => $this->faker->name(),
            'mae' => $this->faker->name('female'),
            'nascimento' => $this->faker->date('Y-m-d'),
            'cpf' => rand(0,99999999999),
            'cns' => rand(1,999999999999999)
        ];
    }
}
