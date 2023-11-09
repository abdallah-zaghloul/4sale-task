<?php

namespace Modules\Transaction\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Modules\Transaction\Enums\CurrencyEnum;
use Modules\Transaction\Enums\ProviderStatusCodeEnum;
use Modules\Transaction\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        if (Schema::hasTable('users') and Schema::hasTable('providers')) :
            $random_ids = fn(string $table): array => DB::table($table)->limit(1000)->pluck('id')->all();

        $def = $this->getDef($random_ids('users'), $random_ids('providers'));
        endif;
        return @$def ?? [];
    }

    public function getDef(array $user_ids, array $provider_ids): array
    {
        return [
            'id' => Str::orderedUuid(),
            'user_id' => fake()->randomElement($user_ids),
            'provider_id' => fake()->randomElement($provider_ids),
            'balance' => fake()->randomFloat(),
            'currency' => fake()->randomElement(CurrencyEnum::cases()),
            'status_code' => fake()->randomElement(ProviderStatusCodeEnum::names()),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

