<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bitacora;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBitacorasTest extends TestCase
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
    public function it_gets_user_bitacoras()
    {
        $user = User::factory()->create();
        $bitacoras = Bitacora::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.bitacoras.index', $user));

        $response->assertOk()->assertSee($bitacoras[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_user_bitacoras()
    {
        $user = User::factory()->create();
        $data = Bitacora::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.bitacoras.store', $user),
            $data
        );

        $this->assertDatabaseHas('bitacoras', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bitacora = Bitacora::latest('id')->first();

        $this->assertEquals($user->id, $bitacora->user_id);
    }
}
