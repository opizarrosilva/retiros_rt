<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Cliente;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteTest extends TestCase
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
    public function it_gets_clientes_list()
    {
        $clientes = Cliente::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.clientes.index'));

        $response->assertOk()->assertSee($clientes[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_cliente()
    {
        $data = Cliente::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.clientes.store'), $data);

        $this->assertDatabaseHas('clientes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.clientes.update', $cliente),
            $data
        );

        $data['id'] = $cliente->id;

        $this->assertDatabaseHas('clientes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_cliente()
    {
        $cliente = Cliente::factory()->create();

        $response = $this->deleteJson(route('api.clientes.destroy', $cliente));

        $this->assertDeleted($cliente);

        $response->assertNoContent();
    }
}
