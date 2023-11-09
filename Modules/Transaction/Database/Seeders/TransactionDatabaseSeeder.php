<?php

namespace Modules\Transaction\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Transaction\Database\factories\TransactionFactory;

class TransactionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        for ($i = 0; $i < 1000; $i++):
        app(TransactionFactory::class)->count(1000)->create();
        endfor;
    }
}
