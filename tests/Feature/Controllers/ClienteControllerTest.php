<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Cliente;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteControllerTest extends TestCase
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
    public function it_displays_index_view_with_clientes()
    {
        $clientes = Cliente::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('clientes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.clientes.index')
            ->assertViewHas('clientes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_cliente()
    {
        $response = $this->get(route('clientes.create'));

        $response->assertOk()->assertViewIs('app.clientes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_cliente()
    {
        $data = Cliente::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('clientes.store'), $data);

        $this->assertDatabaseHas('clientes', $data);

        $cliente = Cliente::latest('id')->first();

        $response->assertRedirect(route('clientes.edit', $cliente));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->get(route('clientes.show', $cliente));

        $response
            ->assertOk()
            ->assertViewIs('app.clientes.show')
            ->assertViewHas('cliente');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->get(route('clientes.edit', $cliente));

        $response
            ->assertOk()
            ->assertViewIs('app.clientes.edit')
            ->assertViewHas('cliente');
    }

    /**
     * @test
     */
    public function it_updates_the_cliente()
    {
        $cliente = Cliente::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
            'codigointerno' => $this->faker->text(255),
        ];

        $response = $this->put(route('clientes.update', $cliente), $data);

        $data['id'] = $cliente->id;

        $this->assertDatabaseHas('clientes', $data);

        $response->assertRedirect(route('clientes.edit', $cliente));
    }

    /**
     * @test
     */
    public function it_deletes_the_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->delete(route('clientes.destroy', $cliente));

        $response->assertRedirect(route('clientes.index'));

        $this->assertDeleted($cliente);
    }
}
