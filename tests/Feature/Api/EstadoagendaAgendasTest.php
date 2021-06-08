<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Estadoagenda;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoagendaAgendasTest extends TestCase
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
    public function it_gets_estadoagenda_agendas()
    {
        $estadoagenda = Estadoagenda::factory()->create();
        $agendas = Agenda::factory()
            ->count(2)
            ->create([
                'estadoagenda_id' => $estadoagenda->id,
            ]);

        $response = $this->getJson(
            route('api.estadoagendas.agendas.index', $estadoagenda)
        );

        $response->assertOk()->assertSee($agendas[0]->fecha);
    }

    /**
     * @test
     */
    public function it_stores_the_estadoagenda_agendas()
    {
        $estadoagenda = Estadoagenda::factory()->create();
        $data = Agenda::factory()
            ->make([
                'estadoagenda_id' => $estadoagenda->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.estadoagendas.agendas.store', $estadoagenda),
            $data
        );

        $this->assertDatabaseHas('agendas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $agenda = Agenda::latest('id')->first();

        $this->assertEquals($estadoagenda->id, $agenda->estadoagenda_id);
    }
}
