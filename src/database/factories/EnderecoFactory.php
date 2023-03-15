<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Paciente;

class EnderecoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cep' => rand(0,99999999),
            'endereco' => $this->faker->streetSuffix(),
            'numero' => $this->faker->buildingNumber(),
            'complemento' => $this->faker->secondaryAddress(),
            'bairro'  => $this->faker->streetName(),
            'cidade' => $this->faker->city(),
            'estado' => rand(0,99),
            'paciente_id' => Paciente::class
        ];
    }
}
