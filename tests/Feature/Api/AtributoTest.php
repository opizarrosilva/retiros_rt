<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Atributo;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AtributoTest extends TestCase
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
    public function it_gets_atributos_list()
    {
        $atributos = Atributo::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.atributos.index'));

        $response->assertOk()->assertSee($atributos[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_atributo()
    {
        $data = Atributo::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.atributos.store'), $data);

        $this->assertDatabaseHas('atributos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_atributo()
    {
        $atributo = Atributo::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.atributos.update', $atributo),
            $data
        );

        $data['id'] = $atributo->id;

        $this->assertDatabaseHas('atributos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_atributo()
    {
        $atributo = Atributo::factory()->create();

        $response = $this->deleteJson(
            route('api.atributos.destroy', $atributo)
        );

        $this->assertDeleted($atributo);

        $response->assertNoContent();
    }
}
