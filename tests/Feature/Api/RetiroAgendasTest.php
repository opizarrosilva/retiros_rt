<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Agenda;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroAgendasTest extends TestCase
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
    public function it_gets_retiro_agendas()
    {
        $retiro = Retiro::factory()->create();
        $agendas = Agenda::factory()
            ->count(2)
            ->create([
                'retiro_id' => $retiro->id,
            ]);

        $response = $this->getJson(route('api.retiros.agendas.index', $retiro));

        $response->assertOk()->assertSee($agendas[0]->fecha);
    }

    /**
     * @test
     */
    public function it_stores_the_retiro_agendas()
    {
        $retiro = Retiro::factory()->create();
        $data = Agenda::factory()
            ->make([
                'retiro_id' => $retiro->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.retiros.agendas.store', $retiro),
            $data
        );

        $this->assertDatabaseHas('agendas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $agenda = Agenda::latest('id')->first();

        $this->assertEquals($retiro->id, $agenda->retiro_id);
    }
}
