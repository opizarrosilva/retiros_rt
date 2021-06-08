<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Estadoretiro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoretiroRetirosTest extends TestCase
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
    public function it_gets_estadoretiro_retiros()
    {
        $estadoretiro = Estadoretiro::factory()->create();
        $retiros = Retiro::factory()
            ->count(2)
            ->create([
                'estadoretiro_id' => $estadoretiro->id,
            ]);

        $response = $this->getJson(
            route('api.estadoretiros.retiros.index', $estadoretiro)
        );

        $response->assertOk()->assertSee($retiros[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_estadoretiro_retiros()
    {
        $estadoretiro = Estadoretiro::factory()->create();
        $data = Retiro::factory()
            ->make([
                'estadoretiro_id' => $estadoretiro->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.estadoretiros.retiros.store', $estadoretiro),
            $data
        );

        $this->assertDatabaseHas('retiros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $retiro = Retiro::latest('id')->first();

        $this->assertEquals($estadoretiro->id, $retiro->estadoretiro_id);
    }
}
