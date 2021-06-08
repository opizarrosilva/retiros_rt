<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Evidencia;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroEvidenciasTest extends TestCase
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
    public function it_gets_retiro_evidencias()
    {
        $retiro = Retiro::factory()->create();
        $evidencias = Evidencia::factory()
            ->count(2)
            ->create([
                'retiro_id' => $retiro->id,
            ]);

        $response = $this->getJson(
            route('api.retiros.evidencias.index', $retiro)
        );

        $response->assertOk()->assertSee($evidencias[0]->url);
    }

    /**
     * @test
     */
    public function it_stores_the_retiro_evidencias()
    {
        $retiro = Retiro::factory()->create();
        $data = Evidencia::factory()
            ->make([
                'retiro_id' => $retiro->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.retiros.evidencias.store', $retiro),
            $data
        );

        $this->assertDatabaseHas('evidencias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $evidencia = Evidencia::latest('id')->first();

        $this->assertEquals($retiro->id, $evidencia->retiro_id);
    }
}
