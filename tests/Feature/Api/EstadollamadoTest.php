<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Estadollamado;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadollamadoTest extends TestCase
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
    public function it_gets_estadollamados_list()
    {
        $estadollamados = Estadollamado::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.estadollamados.index'));

        $response->assertOk()->assertSee($estadollamados[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_estadollamado()
    {
        $data = Estadollamado::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.estadollamados.store'), $data);

        $this->assertDatabaseHas('estadollamados', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.estadollamados.update', $estadollamado),
            $data
        );

        $data['id'] = $estadollamado->id;

        $this->assertDatabaseHas('estadollamados', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_estadollamado()
    {
        $estadollamado = Estadollamado::factory()->create();

        $response = $this->deleteJson(
            route('api.estadollamados.destroy', $estadollamado)
        );

        $this->assertDeleted($estadollamado);

        $response->assertNoContent();
    }
}
