<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Estadoretiro;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoretiroControllerTest extends TestCase
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
    public function it_displays_index_view_with_estadoretiros()
    {
        $estadoretiros = Estadoretiro::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('estadoretiros.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.estadoretiros.index')
            ->assertViewHas('estadoretiros');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_estadoretiro()
    {
        $response = $this->get(route('estadoretiros.create'));

        $response->assertOk()->assertViewIs('app.estadoretiros.create');
    }

    /**
     * @test
     */
    public function it_stores_the_estadoretiro()
    {
        $data = Estadoretiro::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('estadoretiros.store'), $data);

        $this->assertDatabaseHas('estadoretiros', $data);

        $estadoretiro = Estadoretiro::latest('id')->first();

        $response->assertRedirect(route('estadoretiros.edit', $estadoretiro));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_estadoretiro()
    {
        $estadoretiro = Estadoretiro::factory()->create();

        $response = $this->get(route('estadoretiros.show', $estadoretiro));

        $response
            ->assertOk()
            ->assertViewIs('app.estadoretiros.show')
            ->assertViewHas('estadoretiro');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_estadoretiro()
    {
        $estadoretiro = Estadoretiro::factory()->create();

        $response = $this->get(route('estadoretiros.edit', $estadoretiro));

        $response
            ->assertOk()
            ->assertViewIs('app.estadoretiros.edit')
            ->assertViewHas('estadoretiro');
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

        $response = $this->put(
            route('estadoretiros.update', $estadoretiro),
            $data
        );

        $data['id'] = $estadoretiro->id;

        $this->assertDatabaseHas('estadoretiros', $data);

        $response->assertRedirect(route('estadoretiros.edit', $estadoretiro));
    }

    /**
     * @test
     */
    public function it_deletes_the_estadoretiro()
    {
        $estadoretiro = Estadoretiro::factory()->create();

        $response = $this->delete(
            route('estadoretiros.destroy', $estadoretiro)
        );

        $response->assertRedirect(route('estadoretiros.index'));

        $this->assertDeleted($estadoretiro);
    }
}
