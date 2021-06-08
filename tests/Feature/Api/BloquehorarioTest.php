<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Bloquehorario;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloquehorarioTest extends TestCase
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
    public function it_gets_bloquehorarios_list()
    {
        $bloquehorarios = Bloquehorario::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bloquehorarios.index'));

        $response->assertOk()->assertSee($bloquehorarios[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_bloquehorario()
    {
        $data = Bloquehorario::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bloquehorarios.store'), $data);

        $this->assertDatabaseHas('bloquehorarios', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bloquehorario()
    {
        $bloquehorario = Bloquehorario::factory()->create();

        $data = [
            'horainicio' => $this->faker->time,
            'horafin' => $this->faker->time,
        ];

        $response = $this->putJson(
            route('api.bloquehorarios.update', $bloquehorario),
            $data
        );

        $data['id'] = $bloquehorario->id;

        $this->assertDatabaseHas('bloquehorarios', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bloquehorario()
    {
        $bloquehorario = Bloquehorario::factory()->create();

        $response = $this->deleteJson(
            route('api.bloquehorarios.destroy', $bloquehorario)
        );

        $this->assertDeleted($bloquehorario);

        $response->assertNoContent();
    }
}
