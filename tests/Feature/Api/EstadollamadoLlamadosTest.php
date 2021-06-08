<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Llamado;
use App\Models\Estadollamado;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadollamadoLlamadosTest extends TestCase
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
    public function it_gets_estadollamado_llamados()
    {
        $estadollamado = Estadollamado::factory()->create();
        $llamados = Llamado::factory()
            ->count(2)
            ->create([
                'estadollamado_id' => $estadollamado->id,
            ]);

        $response = $this->getJson(
            route('api.estadollamados.llamados.index', $estadollamado)
        );

        $response->assertOk()->assertSee($llamados[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_estadollamado_llamados()
    {
        $estadollamado = Estadollamado::factory()->create();
        $data = Llamado::factory()
            ->make([
                'estadollamado_id' => $estadollamado->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.estadollamados.llamados.store', $estadollamado),
            $data
        );

        $this->assertDatabaseHas('llamados', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $llamado = Llamado::latest('id')->first();

        $this->assertEquals($estadollamado->id, $llamado->estadollamado_id);
    }
}
