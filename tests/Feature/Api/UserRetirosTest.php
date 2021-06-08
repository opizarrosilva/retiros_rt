<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRetirosTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_retiros()
    {
        $user = User::factory()->create();
        $retiros = Retiro::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.retiros.index', $user));

        $response->assertOk()->assertSee($retiros[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_user_retiros()
    {
        $user = User::factory()->create();
        $data = Retiro::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.retiros.store', $user),
            $data
        );

        $this->assertDatabaseHas('retiros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $retiro = Retiro::latest('id')->first();

        $this->assertEquals($user->id, $retiro->user_id);
    }
}
