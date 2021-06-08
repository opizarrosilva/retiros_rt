<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Evidencia;

use App\Models\Retiro;
use App\Models\Tipoevidencia;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EvidenciaTest extends TestCase
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
    public function it_gets_evidencias_list()
    {
        $evidencias = Evidencia::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.evidencias.index'));

        $response->assertOk()->assertSee($evidencias[0]->url);
    }

    /**
     * @test
     */
    public function it_stores_the_evidencia()
    {
        $data = Evidencia::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.evidencias.store'), $data);

        $this->assertDatabaseHas('evidencias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_evidencia()
    {
        $evidencia = Evidencia::factory()->create();

        $retiro = Retiro::factory()->create();
        $tipoevidencia = Tipoevidencia::factory()->create();
        $user = User::factory()->create();

        $data = [
            'url' => $this->faker->text(255),
            'retiro_id' => $retiro->id,
            'tipoevidencia_id' => $tipoevidencia->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.evidencias.update', $evidencia),
            $data
        );

        $data['id'] = $evidencia->id;

        $this->assertDatabaseHas('evidencias', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_evidencia()
    {
        $evidencia = Evidencia::factory()->create();

        $response = $this->deleteJson(
            route('api.evidencias.destroy', $evidencia)
        );

        $this->assertDeleted($evidencia);

        $response->assertNoContent();
    }
}
