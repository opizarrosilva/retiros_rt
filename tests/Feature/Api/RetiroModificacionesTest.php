<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Modificacione;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroModificacionesTest extends TestCase
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
    public function it_gets_retiro_modificaciones()
    {
        $retiro = Retiro::factory()->create();
        $modificaciones = Modificacione::factory()
            ->count(2)
            ->create([
                'retiro_id' => $retiro->id,
            ]);

        $response = $this->getJson(
            route('api.retiros.modificaciones.index', $retiro)
        );

        $response->assertOk()->assertSee($modificaciones[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_retiro_modificaciones()
    {
        $retiro = Retiro::factory()->create();
        $data = Modificacione::factory()
            ->make([
                'retiro_id' => $retiro->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.retiros.modificaciones.store', $retiro),
            $data
        );

        $this->assertDatabaseHas('modificaciones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $modificacione = Modificacione::latest('id')->first();

        $this->assertEquals($retiro->id, $modificacione->retiro_id);
    }
}
