<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Cliente;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClienteRetirosTest extends TestCase
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
    public function it_gets_cliente_retiros()
    {
        $cliente = Cliente::factory()->create();
        $retiros = Retiro::factory()
            ->count(2)
            ->create([
                'cliente_id' => $cliente->id,
            ]);

        $response = $this->getJson(
            route('api.clientes.retiros.index', $cliente)
        );

        $response->assertOk()->assertSee($retiros[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_cliente_retiros()
    {
        $cliente = Cliente::factory()->create();
        $data = Retiro::factory()
            ->make([
                'cliente_id' => $cliente->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.clientes.retiros.store', $cliente),
            $data
        );

        $this->assertDatabaseHas('retiros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $retiro = Retiro::latest('id')->first();

        $this->assertEquals($cliente->id, $retiro->cliente_id);
    }
}
