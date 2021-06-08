<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Estadoagenda;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoagendaTest extends TestCase
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
    public function it_gets_estadoagendas_list()
    {
        $estadoagendas = Estadoagenda::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.estadoagendas.index'));

        $response->assertOk()->assertSee($estadoagendas[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_estadoagenda()
    {
        $data = Estadoagenda::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.estadoagendas.store'), $data);

        $this->assertDatabaseHas('estadoagendas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.estadoagendas.update', $estadoagenda),
            $data
        );

        $data['id'] = $estadoagenda->id;

        $this->assertDatabaseHas('estadoagendas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_estadoagenda()
    {
        $estadoagenda = Estadoagenda::factory()->create();

        $response = $this->deleteJson(
            route('api.estadoagendas.destroy', $estadoagenda)
        );

        $this->assertDeleted($estadoagenda);

        $response->assertNoContent();
    }
}
