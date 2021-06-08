<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agenda;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAgendasTest extends TestCase
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
    public function it_gets_user_agendas()
    {
        $user = User::factory()->create();
        $agendas = Agenda::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.agendas.index', $user));

        $response->assertOk()->assertSee($agendas[0]->fecha);
    }

    /**
     * @test
     */
    public function it_stores_the_user_agendas()
    {
        $user = User::factory()->create();
        $data = Agenda::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.agendas.store', $user),
            $data
        );

        $this->assertDatabaseHas('agendas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $agenda = Agenda::latest('id')->first();

        $this->assertEquals($user->id, $agenda->user_id);
    }
}
