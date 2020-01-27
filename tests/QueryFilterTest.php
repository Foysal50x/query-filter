<?php


namespace Faisal50x\QueryFilter\Tests;

use Faisal50x\QueryFilter\QueryFilterServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Orchestra\Testbench\TestCase;

class QueryFilterTest extends TestCase {

    use WithFaker, RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        require_once __DIR__ . "/../database/migrations/create_users_table.php";
        (new \CreateUsersTable())->up();
    }

    protected function getPackageProviders($app)
    {
        return [QueryFilterServiceProvider::class];
    }

    /** @test */
    public function it_can_register_new_user()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            "username" => $this->faker->unique()->userName,
            "email" => $this->faker->safeEmail,
            "password" => "secret",
            "is_verified" => $this->faker->boolean,
            "status" => $this->faker->randomElement(['active', 'inactive', 'block'])
        ];

        $response = $this->post('/users/store', $attributes);

        $this->assertDatabaseHas('users', $attributes);
    }

    /** @test */
    public function it_can_response_status_ok()
    {
        $response = $this->get("/");

        $response->assertStatus(200);
    }
}
