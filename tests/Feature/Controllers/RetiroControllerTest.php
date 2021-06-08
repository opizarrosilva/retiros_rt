<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Retiro;

use App\Models\Cliente;
use App\Models\Estadoretiro;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RetiroControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_retiros()
    {
        $retiros = Retiro::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('retiros.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.retiros.index')
            ->assertViewHas('retiros');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_retiro()
    {
        $response = $this->get(route('retiros.create'));

        $response->assertOk()->assertViewIs('app.retiros.create');
    }

    /**
     * @test
     */
    public function it_stores_the_retiro()
    {
        $data = Retiro::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('retiros.store'), $data);

        $this->assertDatabaseHas('retiros', $data);

        $retiro = Retiro::latest('id')->first();

        $response->assertRedirect(route('retiros.edit', $retiro));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_retiro()
    {
        $retiro = Retiro::factory()->create();

        $response = $this->get(route('retiros.show', $retiro));

        $response
            ->assertOk()
            ->assertViewIs('app.retiros.show')
            ->assertViewHas('retiro');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_retiro()
    {
        $retiro = Retiro::factory()->create();

        $response = $this->get(route('retiros.edit', $retiro));

        $response
            ->assertOk()
            ->assertViewIs('app.retiros.edit')
            ->assertViewHas('retiro');
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

        $response = $this->put(route('retiros.update', $retiro), $data);

        $data['id'] = $retiro->id;

        $this->assertDatabaseHas('retiros', $data);

        $response->assertRedirect(route('retiros.edit', $retiro));
    }

    /**
     * @test
     */
    public function it_deletes_the_retiro()
    {
        $retiro = Retiro::factory()->create();

        $response = $this->delete(route('retiros.destroy', $retiro));

        $response->assertRedirect(route('retiros.index'));

        $this->assertDeleted($retiro);
    }
}
