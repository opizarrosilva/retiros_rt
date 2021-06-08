<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Estadoagenda;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoagendaControllerTest extends TestCase
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
    public function it_displays_index_view_with_estadoagendas()
    {
        $estadoagendas = Estadoagenda::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('estadoagendas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.estadoagendas.index')
            ->assertViewHas('estadoagendas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_estadoagenda()
    {
        $response = $this->get(route('estadoagendas.create'));

        $response->assertOk()->assertViewIs('app.estadoagendas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_estadoagenda()
    {
        $data = Estadoagenda::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('estadoagendas.store'), $data);

        $this->assertDatabaseHas('estadoagendas', $data);

        $estadoagenda = Estadoagenda::latest('id')->first();

        $response->assertRedirect(route('estadoagendas.edit', $estadoagenda));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_estadoagenda()
    {
        $estadoagenda = Estadoagenda::factory()->create();

        $response = $this->get(route('estadoagendas.show', $estadoagenda));

        $response
            ->assertOk()
            ->assertViewIs('app.estadoagendas.show')
            ->assertViewHas('estadoagenda');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_estadoagenda()
    {
        $estadoagenda = Estadoagenda::factory()->create();

        $response = $this->get(route('estadoagendas.edit', $estadoagenda));

        $response
            ->assertOk()
            ->assertViewIs('app.estadoagendas.edit')
            ->assertViewHas('estadoagenda');
    }

    /**
     * @test
     */
    public function it_updates_the_estadoagenda()
    {
        $estadoagenda = Estadoagenda::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('estadoagendas.update', $estadoagenda),
            $data
        );

        $data['id'] = $estadoagenda->id;

        $this->assertDatabaseHas('estadoagendas', $data);

        $response->assertRedirect(route('estadoagendas.edit', $estadoagenda));
    }

    /**
     * @test
     */
    public function it_deletes_the_estadoagenda()
    {
        $estadoagenda = Estadoagenda::factory()->create();

        $response = $this->delete(
            route('estadoagendas.destroy', $estadoagenda)
        );

        $response->assertRedirect(route('estadoagendas.index'));

        $this->assertDeleted($estadoagenda);
    }
}
