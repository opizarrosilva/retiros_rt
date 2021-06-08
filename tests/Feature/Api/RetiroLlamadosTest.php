<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Llamado;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroLlamadosTest extends TestCase
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
    public function it_gets_retiro_llamados()
    {
        $retiro = Retiro::factory()->create();
        $llamados = Llamado::factory()
            ->count(2)
            ->create([
                'retiro_id' => $retiro->id,
            ]);

        $response = $this->getJson(
            route('api.retiros.llamados.index', $retiro)
        );

        $response->assertOk()->assertSee($llamados[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_retiro_llamados()
    {
        $retiro = Retiro::factory()->create();
        $data = Llamado::factory()
            ->make([
                'retiro_id' => $retiro->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.retiros.llamados.store', $retiro),
            $data
        );

        $this->assertDatabaseHas('llamados', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $llamado = Llamado::latest('id')->first();

        $this->assertEquals($retiro->id, $llamado->retiro_id);
    }
}
