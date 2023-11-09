<?php

namespace Modules\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\User\Database\Seeders\UserDatabaseSeeder;
use Tests\TestCase;

class UsersIndexFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Feature test example.
     *
     * @return void
     */
    public function test_users_index_feature()
    {
       app(UserDatabaseSeeder::class)->run(2,1000);
       $baseUrl = "api/v1/users";
       $response = $this->get($baseUrl);
       $users = data_get($response->json(),'data.users');
       $response->assertSuccessful();
       $this->assertNotEmpty($users);
    }
}
