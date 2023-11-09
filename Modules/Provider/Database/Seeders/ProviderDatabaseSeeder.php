<?php

namespace Modules\Provider\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Provider\Database\factories\ProviderFactory;
use Modules\Provider\Enums\ProviderEnum;

class ProviderDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        [$factory, $count] = [app(ProviderFactory::class), ProviderEnum::collection()->count()];
        $factory->count($count)->create();
    }
}
