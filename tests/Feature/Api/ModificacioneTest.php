<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Modificacione;

use App\Models\Retiro;
use App\Models\Atributo;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModificacioneTest extends TestCase
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
    public function it_gets_modificaciones_list()
    {
        $modificaciones = Modificacione::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.modificaciones.index'));

        $response->assertOk()->assertSee($modificaciones[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_modificacione()
    {
        $data = Modificacione::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.modificaciones.store'), $data);

        $this->assertDatabaseHas('modificaciones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_modificacione()
    {
        $modificacione = Modificacione::factory()->create();

        $retiro = Retiro::factory()->create();
        $atributo = Atributo::factory()->create();
        $user = User::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
            'retiro_id' => $retiro->id,
            'atributo_id' => $atributo->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.modificaciones.update', $modificacione),
            $data
        );

        $data['id'] = $modificacione->id;

        $this->assertDatabaseHas('modificaciones', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_modificacione()
    {
        $modificacione = Modificacione::factory()->create();

        $response = $this->deleteJson(
            route('api.modificaciones.destroy', $modificacione)
        );

        $this->assertDeleted($modificacione);

        $response->assertNoContent();
    }
}
