<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Llamado;

use App\Models\Retiro;
use App\Models\Estadollamado;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LlamadoControllerTest extends TestCase
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
    public function it_displays_index_view_with_llamados()
    {
        $llamados = Llamado::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('llamados.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.llamados.index')
            ->assertViewHas('llamados');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_llamado()
    {
        $response = $this->get(route('llamados.create'));

        $response->assertOk()->assertViewIs('app.llamados.create');
    }

    /**
     * @test
     */
    public function it_stores_the_llamado()
    {
        $data = Llamado::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('llamados.store'), $data);

        $this->assertDatabaseHas('llamados', $data);

        $llamado = Llamado::latest('id')->first();

        $response->assertRedirect(route('llamados.edit', $llamado));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_llamado()
    {
        $llamado = Llamado::factory()->create();

        $response = $this->get(route('llamados.show', $llamado));

        $response
            ->assertOk()
            ->assertViewIs('app.llamados.show')
            ->assertViewHas('llamado');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_llamado()
    {
        $llamado = Llamado::factory()->create();

        $response = $this->get(route('llamados.edit', $llamado));

        $response
            ->assertOk()
            ->assertViewIs('app.llamados.edit')
            ->assertViewHas('llamado');
    }

    /**
     * @test
     */
    public function it_updates_the_llamado()
    {
        $llamado = Llamado::factory()->create();

        $estadollamado = Estadollamado::factory()->create();
        $retiro = Retiro::factory()->create();
        $user = User::factory()->create();

        $data = [
            'estadollamado_id' => $estadollamado->id,
            'retiro_id' => $retiro->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('llamados.update', $llamado), $data);

        $data['id'] = $llamado->id;

        $this->assertDatabaseHas('llamados', $data);

        $response->assertRedirect(route('llamados.edit', $llamado));
    }

    /**
     * @test
     */
    public function it_deletes_the_llamado()
    {
        $llamado = Llamado::factory()->create();

        $response = $this->delete(route('llamados.destroy', $llamado));

        $response->assertRedirect(route('llamados.index'));

        $this->assertDeleted($llamado);
    }
}
