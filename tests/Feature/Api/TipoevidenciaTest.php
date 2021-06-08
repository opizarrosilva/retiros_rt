<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Tipoevidencia;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipoevidenciaTest extends TestCase
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
    public function it_gets_tipoevidencias_list()
    {
        $tipoevidencias = Tipoevidencia::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tipoevidencias.index'));

        $response->assertOk()->assertSee($tipoevidencias[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_tipoevidencia()
    {
        $data = Tipoevidencia::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tipoevidencias.store'), $data);

        $this->assertDatabaseHas('tipoevidencias', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_tipoevidencia()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.tipoevidencias.update', $tipoevidencia),
            $data
        );

        $data['id'] = $tipoevidencia->id;

        $this->assertDatabaseHas('tipoevidencias', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tipoevidencia()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();

        $response = $this->deleteJson(
            route('api.tipoevidencias.destroy', $tipoevidencia)
        );

        $this->assertDeleted($tipoevidencia);

        $response->assertNoContent();
    }
}
