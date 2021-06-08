<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Evidencia;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserEvidenciasTest extends TestCase
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
    public function it_gets_user_evidencias()
    {
        $user = User::factory()->create();
        $evidencias = Evidencia::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.evidencias.index', $user));

        $response->assertOk()->assertSee($evidencias[0]->url);
    }

    /**
     * @test
     */
    public function it_stores_the_user_evidencias()
    {
        $user = User::factory()->create();
        $data = Evidencia::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.evidencias.store', $user),
            $data
        );

        $this->assertDatabaseHas('evidencias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $evidencia = Evidencia::latest('id')->first();

        $this->assertEquals($user->id, $evidencia->user_id);
    }
}
