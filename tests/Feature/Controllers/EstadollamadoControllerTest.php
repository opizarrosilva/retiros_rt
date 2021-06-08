<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Estadollamado;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadollamadoControllerTest extends TestCase
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
    public function it_displays_index_view_with_estadollamados()
    {
        $estadollamados = Estadollamado::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('estadollamados.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.estadollamados.index')
            ->assertViewHas('estadollamados');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_estadollamado()
    {
        $response = $this->get(route('estadollamados.create'));

        $response->assertOk()->assertViewIs('app.estadollamados.create');
    }

    /**
     * @test
     */
    public function it_stores_the_estadollamado()
    {
        $data = Estadollamado::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('estadollamados.store'), $data);

        $this->assertDatabaseHas('estadollamados', $data);

        $estadollamado = Estadollamado::latest('id')->first();

        $response->assertRedirect(route('estadollamados.edit', $estadollamado));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_estadollamado()
    {
        $estadollamado = Estadollamado::factory()->create();

        $response = $this->get(route('estadollamados.show', $estadollamado));

        $response
            ->assertOk()
            ->assertViewIs('app.estadollamados.show')
            ->assertViewHas('estadollamado');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_estadollamado()
    {
        $estadollamado = Estadollamado::factory()->create();

        $response = $this->get(route('estadollamados.edit', $estadollamado));

        $response
            ->assertOk()
            ->assertViewIs('app.estadollamados.edit')
            ->assertViewHas('estadollamado');
    }

    /**
     * @test
     */
    public function it_updates_the_estadollamado()
    {
        $estadollamado = Estadollamado::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('estadollamados.update', $estadollamado),
            $data
        );

        $data['id'] = $estadollamado->id;

        $this->assertDatabaseHas('estadollamados', $data);

        $response->assertRedirect(route('estadollamados.edit', $estadollamado));
    }

    /**
     * @test
     */
    public function it_deletes_the_estadollamado()
    {
        $estadollamado = Estadollamado::factory()->create();

        $response = $this->delete(
            route('estadollamados.destroy', $estadollamado)
        );

        $response->assertRedirect(route('estadollamados.index'));

        $this->assertDeleted($estadollamado);
    }
}
