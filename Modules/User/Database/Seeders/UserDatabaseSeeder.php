<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Modules\Provider\Database\factories\ProviderFactory;
use Modules\Provider\Database\Seeders\ProviderDatabaseSeeder;
use Modules\Transaction\Database\factories\TransactionFactory;
use Modules\Transaction\Models\Transaction;
use Modules\User\Database\factories\UserFactory;
use Modules\User\Models\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(?int $batches = 10000, ?int $records = 1000)
    {
        Model::unguard();
        $provider_ids = $this->getProviderIDs();

        for ($i = 0; $i < $batches; $i++){
            $users = collect(range(0, $records))->transform(fn($value) => app(UserFactory::class)->definition());
            $transactions = $users->pluck('id')->transform(fn($user_id) => app(TransactionFactory::class)->getDef([$user_id],$provider_ids));
            User::query()->insert($users->all());
            Transaction::query()->insert($transactions->all());
        };
    }

    protected function getProviderIDs(): array
    {
        $getIDs = fn(string $table):Collection => DB::table($table)->pluck('id');
        return $getIDs('providers')->whenEmpty(function(Collection $ids) use ($getIDs) {
            app(ProviderDatabaseSeeder::class)->run();
            return $getIDs('providers');
        })->all();
    }
}
