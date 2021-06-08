<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Estadoretiro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoretiroTest extends TestCase
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
    public function it_gets_estadoretiros_list()
    {
        $estadoretiros = Estadoretiro::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.estadoretiros.index'));

        $response->assertOk()->assertSee($estadoretiros[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_estadoretiro()
    {
        $data = Estadoretiro::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.estadoretiros.store'), $data);

        $this->assertDatabaseHas('estadoretiros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_estadoretiro()
    {
        $estadoretiro = Estadoretiro::factory()->create();

        $data = [
            'glosa' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.estadoretiros.update', $estadoretiro),
            $data
        );

        $data['id'] = $estadoretiro->id;

        $this->assertDatabaseHas('estadoretiros', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_estadoretiro()
    {
        $estadoretiro = Estadoretiro::factory()->create();

        $response = $this->deleteJson(
            route('api.estadoretiros.destroy', $estadoretiro)
        );

        $this->assertDeleted($estadoretiro);

        $response->assertNoContent();
    }
}
