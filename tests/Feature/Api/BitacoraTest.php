<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bitacora;

use App\Models\Retiro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BitacoraTest extends TestCase
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
    public function it_gets_bitacoras_list()
    {
        $bitacoras = Bitacora::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bitacoras.index'));

        $response->assertOk()->assertSee($bitacoras[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_bitacora()
    {
        $data = Bitacora::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bitacoras.store'), $data);

        $this->assertDatabaseHas('bitacoras', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.bitacoras.update', $bitacora),
            $data
        );

        $data['id'] = $bitacora->id;

        $this->assertDatabaseHas('bitacoras', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bitacora()
    {
        $bitacora = Bitacora::factory()->create();

        $response = $this->deleteJson(
            route('api.bitacoras.destroy', $bitacora)
        );

        $this->assertDeleted($bitacora);

        $response->assertNoContent();
    }
}
