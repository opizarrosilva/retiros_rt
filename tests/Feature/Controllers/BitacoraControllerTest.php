<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Bitacora;

use App\Models\Retiro;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BitacoraControllerTest extends TestCase
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
    public function it_displays_index_view_with_bitacoras()
    {
        $bitacoras = Bitacora::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bitacoras.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bitacoras.index')
            ->assertViewHas('bitacoras');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bitacora()
    {
        $response = $this->get(route('bitacoras.create'));

        $response->assertOk()->assertViewIs('app.bitacoras.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bitacora()
    {
        $data = Bitacora::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bitacoras.store'), $data);

        $this->assertDatabaseHas('bitacoras', $data);

        $bitacora = Bitacora::latest('id')->first();

        $response->assertRedirect(route('bitacoras.edit', $bitacora));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bitacora()
    {
        $bitacora = Bitacora::factory()->create();

        $response = $this->get(route('bitacoras.show', $bitacora));

        $response
            ->assertOk()
            ->assertViewIs('app.bitacoras.show')
            ->assertViewHas('bitacora');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bitacora()
    {
        $bitacora = Bitacora::factory()->create();

        $response = $this->get(route('bitacoras.edit', $bitacora));

        $response
            ->assertOk()
            ->assertViewIs('app.bitacoras.edit')
            ->assertViewHas('bitacora');
    }

    /**
     * @test
     */
    public function it_updates_the_bitacora()
    {
        $bitacora = Bitacora::factory()->create();

        $retiro = Retiro::factory()->create();
        $user = User::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
            'retiro_id' => $retiro->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('bitacoras.update', $bitacora), $data);

        $data['id'] = $bitacora->id;

        $this->assertDatabaseHas('bitacoras', $data);

        $response->assertRedirect(route('bitacoras.edit', $bitacora));
    }

    /**
     * @test
     */
    public function it_deletes_the_bitacora()
    {
        $bitacora = Bitacora::factory()->create();

        $response = $this->delete(route('bitacoras.destroy', $bitacora));

        $response->assertRedirect(route('bitacoras.index'));

        $this->assertDeleted($bitacora);
    }
}
