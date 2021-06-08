<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Modificacione;

use App\Models\Retiro;
use App\Models\Atributo;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModificacioneControllerTest extends TestCase
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
    public function it_displays_index_view_with_modificaciones()
    {
        $modificaciones = Modificacione::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('modificaciones.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.modificaciones.index')
            ->assertViewHas('modificaciones');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_modificacione()
    {
        $response = $this->get(route('modificaciones.create'));

        $response->assertOk()->assertViewIs('app.modificaciones.create');
    }

    /**
     * @test
     */
    public function it_stores_the_modificacione()
    {
        $data = Modificacione::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('modificaciones.store'), $data);

        $this->assertDatabaseHas('modificaciones', $data);

        $modificacione = Modificacione::latest('id')->first();

        $response->assertRedirect(route('modificaciones.edit', $modificacione));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_modificacione()
    {
        $modificacione = Modificacione::factory()->create();

        $response = $this->get(route('modificaciones.show', $modificacione));

        $response
            ->assertOk()
            ->assertViewIs('app.modificaciones.show')
            ->assertViewHas('modificacione');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_modificacione()
    {
        $modificacione = Modificacione::factory()->create();

        $response = $this->get(route('modificaciones.edit', $modificacione));

        $response
            ->assertOk()
            ->assertViewIs('app.modificaciones.edit')
            ->assertViewHas('modificacione');
    }

    /**
     * @test
     */
    public function it_updates_the_modificacione()
    {
        $modificacione = Modificacione::factory()->create();

        $retiro = Retiro::factory()->create();
        $atributo = Atributo::factory()->create();
        $user = User::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
            'retiro_id' => $retiro->id,
            'atributo_id' => $atributo->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(
            route('modificaciones.update', $modificacione),
            $data
        );

        $data['id'] = $modificacione->id;

        $this->assertDatabaseHas('modificaciones', $data);

        $response->assertRedirect(route('modificaciones.edit', $modificacione));
    }

    /**
     * @test
     */
    public function it_deletes_the_modificacione()
    {
        $modificacione = Modificacione::factory()->create();

        $response = $this->delete(
            route('modificaciones.destroy', $modificacione)
        );

        $response->assertRedirect(route('modificaciones.index'));

        $this->assertDeleted($modificacione);
    }
}
