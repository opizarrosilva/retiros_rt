<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Llamado;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLlamadosTest extends TestCase
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
    public function it_gets_user_llamados()
    {
        $user = User::factory()->create();
        $llamados = Llamado::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.llamados.index', $user));

        $response->assertOk()->assertSee($llamados[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_llamados()
    {
        $user = User::factory()->create();
        $data = Llamado::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.llamados.store', $user),
            $data
        );

        $this->assertDatabaseHas('llamados', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $llamado = Llamado::latest('id')->first();

        $this->assertEquals($user->id, $llamado->user_id);
    }
}
