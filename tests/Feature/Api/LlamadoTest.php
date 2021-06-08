<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Llamado;

use App\Models\Retiro;
use App\Models\Estadollamado;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LlamadoTest extends TestCase
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
    public function it_gets_llamados_list()
    {
        $llamados = Llamado::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.llamados.index'));

        $response->assertOk()->assertSee($llamados[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_llamado()
    {
        $data = Llamado::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.llamados.store'), $data);

        $this->assertDatabaseHas('llamados', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.llamados.update', $llamado),
            $data
        );

        $data['id'] = $llamado->id;

        $this->assertDatabaseHas('llamados', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_llamado()
    {
        $llamado = Llamado::factory()->create();

        $response = $this->deleteJson(route('api.llamados.destroy', $llamado));

        $this->assertDeleted($llamado);

        $response->assertNoContent();
    }
}
