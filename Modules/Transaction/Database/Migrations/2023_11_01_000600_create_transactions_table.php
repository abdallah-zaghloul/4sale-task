<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Modules\Transaction\Enums\CurrencyEnum;
use Modules\Transaction\Enums\ProviderStatusCodeEnum;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('provider_id')->constrained();
            $table->decimal('balance',12)->index();
            $table->enum('currency', CurrencyEnum::values())->index();
            $table->enum('status_code', ProviderStatusCodeEnum::names())->index();
            $table->timestamp('created_at')->index();
            $table->timestamp('updated_at');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}
};
