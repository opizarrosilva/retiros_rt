<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Atributo;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AtributoControllerTest extends TestCase
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
    public function it_displays_index_view_with_atributos()
    {
        $atributos = Atributo::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('atributos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.atributos.index')
            ->assertViewHas('atributos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_atributo()
    {
        $response = $this->get(route('atributos.create'));

        $response->assertOk()->assertViewIs('app.atributos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_atributo()
    {
        $data = Atributo::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('atributos.store'), $data);

        $this->assertDatabaseHas('atributos', $data);

        $atributo = Atributo::latest('id')->first();

        $response->assertRedirect(route('atributos.edit', $atributo));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_atributo()
    {
        $atributo = Atributo::factory()->create();

        $response = $this->get(route('atributos.show', $atributo));

        $response
            ->assertOk()
            ->assertViewIs('app.atributos.show')
            ->assertViewHas('atributo');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_atributo()
    {
        $atributo = Atributo::factory()->create();

        $response = $this->get(route('atributos.edit', $atributo));

        $response
            ->assertOk()
            ->assertViewIs('app.atributos.edit')
            ->assertViewHas('atributo');
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

        $response = $this->put(route('atributos.update', $atributo), $data);

        $data['id'] = $atributo->id;

        $this->assertDatabaseHas('atributos', $data);

        $response->assertRedirect(route('atributos.edit', $atributo));
    }

    /**
     * @test
     */
    public function it_deletes_the_atributo()
    {
        $atributo = Atributo::factory()->create();

        $response = $this->delete(route('atributos.destroy', $atributo));

        $response->assertRedirect(route('atributos.index'));

        $this->assertDeleted($atributo);
    }
}
