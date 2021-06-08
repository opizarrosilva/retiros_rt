<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Bitacora;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroBitacorasTest extends TestCase
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
    public function it_gets_retiro_bitacoras()
    {
        $retiro = Retiro::factory()->create();
        $bitacoras = Bitacora::factory()
            ->count(2)
            ->create([
                'retiro_id' => $retiro->id,
            ]);

        $response = $this->getJson(
            route('api.retiros.bitacoras.index', $retiro)
        );

        $response->assertOk()->assertSee($bitacoras[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_retiro_bitacoras()
    {
        $retiro = Retiro::factory()->create();
        $data = Bitacora::factory()
            ->make([
                'retiro_id' => $retiro->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.retiros.bitacoras.store', $retiro),
            $data
        );

        $this->assertDatabaseHas('bitacoras', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bitacora = Bitacora::latest('id')->first();

        $this->assertEquals($retiro->id, $bitacora->retiro_id);
    }
}
