<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->name(),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'stock' => $this->faker->randomNumber(),
            'date_in_wh' => $this->faker->dateTime(),
            'date_expiry' => $this->faker->date(),
            'active' => $this->faker->boolean(),
            'updated_at' => $this->faker->date(),
            'created_at' => $this->faker->date(),
        ];
    }
}
