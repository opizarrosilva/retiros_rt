<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Agenda;

use App\Models\Retiro;
use App\Models\Estadoagenda;
use App\Models\Bloquehorario;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgendaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_agendas()
    {
        $agendas = Agenda::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('agendas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.agendas.index')
            ->assertViewHas('agendas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_agenda()
    {
        $response = $this->get(route('agendas.create'));

        $response->assertOk()->assertViewIs('app.agendas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_agenda()
    {
        $data = Agenda::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('agendas.store'), $data);

        $this->assertDatabaseHas('agendas', $data);

        $agenda = Agenda::latest('id')->first();

        $response->assertRedirect(route('agendas.edit', $agenda));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_agenda()
    {
        $agenda = Agenda::factory()->create();

        $response = $this->get(route('agendas.show', $agenda));

        $response
            ->assertOk()
            ->assertViewIs('app.agendas.show')
            ->assertViewHas('agenda');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_agenda()
    {
        $agenda = Agenda::factory()->create();

        $response = $this->get(route('agendas.edit', $agenda));

        $response
            ->assertOk()
            ->assertViewIs('app.agendas.edit')
            ->assertViewHas('agenda');
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

        $response = $this->put(route('agendas.update', $agenda), $data);

        $data['id'] = $agenda->id;

        $this->assertDatabaseHas('agendas', $data);

        $response->assertRedirect(route('agendas.edit', $agenda));
    }

    /**
     * @test
     */
    public function it_deletes_the_agenda()
    {
        $agenda = Agenda::factory()->create();

        $response = $this->delete(route('agendas.destroy', $agenda));

        $response->assertRedirect(route('agendas.index'));

        $this->assertDeleted($agenda);
    }
}
