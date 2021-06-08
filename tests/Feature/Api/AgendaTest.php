<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agenda;

use App\Models\Retiro;
use App\Models\Estadoagenda;
use App\Models\Bloquehorario;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendaTest extends TestCase
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
    public function it_gets_agendas_list()
    {
        $agendas = Agenda::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.agendas.index'));

        $response->assertOk()->assertSee($agendas[0]->fecha);
    }

    /**
     * @test
     */
    public function it_stores_the_agenda()
    {
        $data = Agenda::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.agendas.store'), $data);

        $this->assertDatabaseHas('agendas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_agenda()
    {
        $agenda = Agenda::factory()->create();

        $bloquehorario = Bloquehorario::factory()->create();
        $retiro = Retiro::factory()->create();
        $user = User::factory()->create();
        $estadoagenda = Estadoagenda::factory()->create();

        $data = [
            'fecha' => $this->faker->date,
            'glosa' => $this->faker->text(255),
            'bloquehorario_id' => $bloquehorario->id,
            'retiro_id' => $retiro->id,
            'user_id' => $user->id,
            'estadoagenda_id' => $estadoagenda->id,
        ];

        $response = $this->putJson(route('api.agendas.update', $agenda), $data);

        $data['id'] = $agenda->id;

        $this->assertDatabaseHas('agendas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_agenda()
    {
        $agenda = Agenda::factory()->create();

        $response = $this->deleteJson(route('api.agendas.destroy', $agenda));

        $this->assertDeleted($agenda);

        $response->assertNoContent();
    }
}
