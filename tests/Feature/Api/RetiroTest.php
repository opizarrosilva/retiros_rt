<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Retiro;

use App\Models\Cliente;
use App\Models\Estadoretiro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroTest extends TestCase
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
    public function it_gets_retiros_list()
    {
        $retiros = Retiro::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.retiros.index'));

        $response->assertOk()->assertSee($retiros[0]->glosa);
    }

    /**
     * @test
     */
    public function it_stores_the_retiro()
    {
        $data = Retiro::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.retiros.store'), $data);

        $this->assertDatabaseHas('retiros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_retiro()
    {
        $retiro = Retiro::factory()->create();

        $cliente = Cliente::factory()->create();
        $estadoretiro = Estadoretiro::factory()->create();
        $user = User::factory()->create();

        $data = [
            'glosa' => $this->faker->text,
            'fechacarga' => $this->faker->dateTime,
            'cliente_id' => $cliente->id,
            'estadoretiro_id' => $estadoretiro->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.retiros.update', $retiro), $data);

        $data['id'] = $retiro->id;

        $this->assertDatabaseHas('retiros', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_retiro()
    {
        $retiro = Retiro::factory()->create();

        $response = $this->deleteJson(route('api.retiros.destroy', $retiro));

        $this->assertDeleted($retiro);

        $response->assertNoContent();
    }
}
