<?php

namespace Modules\Provider\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Provider\Enums\ProviderEnum;
use Modules\Provider\Models\Provider;

class ProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider' => fake()->unique()->randomElement(ProviderEnum::cases()),
        ];
    }
}

