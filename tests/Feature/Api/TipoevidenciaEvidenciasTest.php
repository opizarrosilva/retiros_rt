<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Evidencia;
use App\Models\Tipoevidencia;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipoevidenciaEvidenciasTest extends TestCase
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
    public function it_gets_tipoevidencia_evidencias()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();
        $evidencias = Evidencia::factory()
            ->count(2)
            ->create([
                'tipoevidencia_id' => $tipoevidencia->id,
            ]);

        $response = $this->getJson(
            route('api.tipoevidencias.evidencias.index', $tipoevidencia)
        );

        $response->assertOk()->assertSee($evidencias[0]->url);
    }

    /**
     * @test
     */
    public function it_stores_the_tipoevidencia_evidencias()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();
        $data = Evidencia::factory()
            ->make([
                'tipoevidencia_id' => $tipoevidencia->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.tipoevidencias.evidencias.store', $tipoevidencia),
            $data
        );

        $this->assertDatabaseHas('evidencias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $evidencia = Evidencia::latest('id')->first();

        $this->assertEquals($tipoevidencia->id, $evidencia->tipoevidencia_id);
    }
}
