<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Tipoevidencia;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TipoevidenciaControllerTest extends TestCase
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
    public function it_displays_index_view_with_tipoevidencias()
    {
        $tipoevidencias = Tipoevidencia::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tipoevidencias.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tipoevidencias.index')
            ->assertViewHas('tipoevidencias');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tipoevidencia()
    {
        $response = $this->get(route('tipoevidencias.create'));

        $response->assertOk()->assertViewIs('app.tipoevidencias.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tipoevidencia()
    {
        $data = Tipoevidencia::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tipoevidencias.store'), $data);

        $this->assertDatabaseHas('tipoevidencias', $data);

        $tipoevidencia = Tipoevidencia::latest('id')->first();

        $response->assertRedirect(route('tipoevidencias.edit', $tipoevidencia));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tipoevidencia()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();

        $response = $this->get(route('tipoevidencias.show', $tipoevidencia));

        $response
            ->assertOk()
            ->assertViewIs('app.tipoevidencias.show')
            ->assertViewHas('tipoevidencia');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tipoevidencia()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();

        $response = $this->get(route('tipoevidencias.edit', $tipoevidencia));

        $response
            ->assertOk()
            ->assertViewIs('app.tipoevidencias.edit')
            ->assertViewHas('tipoevidencia');
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

        $response = $this->put(
            route('tipoevidencias.update', $tipoevidencia),
            $data
        );

        $data['id'] = $tipoevidencia->id;

        $this->assertDatabaseHas('tipoevidencias', $data);

        $response->assertRedirect(route('tipoevidencias.edit', $tipoevidencia));
    }

    /**
     * @test
     */
    public function it_deletes_the_tipoevidencia()
    {
        $tipoevidencia = Tipoevidencia::factory()->create();

        $response = $this->delete(
            route('tipoevidencias.destroy', $tipoevidencia)
        );

        $response->assertRedirect(route('tipoevidencias.index'));

        $this->assertDeleted($tipoevidencia);
    }
}
