<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nickname' => $this->faker->word(),
            'domain_name' => $this->faker->unique()->domainName(),
            'host' => $this->faker->localIpv4() . ':' . $this->faker->numberBetween('15', '33333'),
            'enabled' => $this->faker->boolean()
        ];
    }
}
