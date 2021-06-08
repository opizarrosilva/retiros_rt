<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Bloquehorario;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloquehorarioAgendasTest extends TestCase
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
    public function it_gets_bloquehorario_agendas()
    {
        $bloquehorario = Bloquehorario::factory()->create();
        $agendas = Agenda::factory()
            ->count(2)
            ->create([
                'bloquehorario_id' => $bloquehorario->id,
            ]);

        $response = $this->getJson(
            route('api.bloquehorarios.agendas.index', $bloquehorario)
        );

        $response->assertOk()->assertSee($agendas[0]->fecha);
    }

    /**
     * @test
     */
    public function it_stores_the_bloquehorario_agendas()
    {
        $bloquehorario = Bloquehorario::factory()->create();
        $data = Agenda::factory()
            ->make([
                'bloquehorario_id' => $bloquehorario->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.bloquehorarios.agendas.store', $bloquehorario),
            $data
        );

        $this->assertDatabaseHas('agendas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $agenda = Agenda::latest('id')->first();

        $this->assertEquals($bloquehorario->id, $agenda->bloquehorario_id);
    }
}
