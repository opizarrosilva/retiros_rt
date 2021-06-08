<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Modificacione;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModificacionesTest extends TestCase
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
    public function it_gets_user_modificaciones()
    {
        $user = User::factory()->create();
        $modificaciones = Modificacione::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.modificaciones.index', $user)
        );

        $response->assertOk()->assertSee($modificaciones[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_user_modificaciones()
    {
        $user = User::factory()->create();
        $data = Modificacione::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.modificaciones.store', $user),
            $data
        );

        $this->assertDatabaseHas('modificaciones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $modificacione = Modificacione::latest('id')->first();

        $this->assertEquals($user->id, $modificacione->user_id);
    }
}
