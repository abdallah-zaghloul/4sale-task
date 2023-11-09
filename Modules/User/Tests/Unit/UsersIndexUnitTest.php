<?php

namespace Modules\User\Tests\Unit;

use Illuminate\Support\Benchmark;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Modules\User\Services\UsersIndexService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersIndexUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_users_index_service()
    {
        app(UserDatabaseSeeder::class)->run(2,1000);
        $result = app(UsersIndexService::class)->execute();
        $this->assertNotEmpty($result);
        $benchmark = fn(): array|float => Benchmark::measure(fn() => $result);
        echo(is_array($benchmark()) ? implode(PHP_EOL, $benchmark()) : $benchmark());
    }
}
