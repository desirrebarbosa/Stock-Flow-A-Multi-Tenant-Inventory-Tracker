<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => \App\Models\Company::factory(),
            'sku'=> $this->faker->unique()->strtoupper($this->faker->bothify('????####')),
            // use true to get space separated string
            'name' => $this->faker->words(2, true),
            'current_stock' => $this->faker->numberBetween(10, 100),


        ];
    }
}
