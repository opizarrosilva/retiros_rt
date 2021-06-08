<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Atributo;
use App\Models\Modificacione;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AtributoModificacionesTest extends TestCase
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
    public function it_gets_atributo_modificaciones()
    {
        $atributo = Atributo::factory()->create();
        $modificaciones = Modificacione::factory()
            ->count(2)
            ->create([
                'atributo_id' => $atributo->id,
            ]);

        $response = $this->getJson(
            route('api.atributos.modificaciones.index', $atributo)
        );

        $response->assertOk()->assertSee($modificaciones[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_atributo_modificaciones()
    {
        $atributo = Atributo::factory()->create();
        $data = Modificacione::factory()
            ->make([
                'atributo_id' => $atributo->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.atributos.modificaciones.store', $atributo),
            $data
        );

        $this->assertDatabaseHas('modificaciones', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $modificacione = Modificacione::latest('id')->first();

        $this->assertEquals($atributo->id, $modificacione->atributo_id);
    }
}
