<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Bloquehorario;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BloquehorarioControllerTest extends TestCase
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
    public function it_displays_index_view_with_bloquehorarios()
    {
        $bloquehorarios = Bloquehorario::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('bloquehorarios.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.bloquehorarios.index')
            ->assertViewHas('bloquehorarios');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_bloquehorario()
    {
        $response = $this->get(route('bloquehorarios.create'));

        $response->assertOk()->assertViewIs('app.bloquehorarios.create');
    }

    /**
     * @test
     */
    public function it_stores_the_bloquehorario()
    {
        $data = Bloquehorario::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('bloquehorarios.store'), $data);

        $this->assertDatabaseHas('bloquehorarios', $data);

        $bloquehorario = Bloquehorario::latest('id')->first();

        $response->assertRedirect(route('bloquehorarios.edit', $bloquehorario));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_bloquehorario()
    {
        $bloquehorario = Bloquehorario::factory()->create();

        $response = $this->get(route('bloquehorarios.show', $bloquehorario));

        $response
            ->assertOk()
            ->assertViewIs('app.bloquehorarios.show')
            ->assertViewHas('bloquehorario');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_bloquehorario()
    {
        $bloquehorario = Bloquehorario::factory()->create();

        $response = $this->get(route('bloquehorarios.edit', $bloquehorario));

        $response
            ->assertOk()
            ->assertViewIs('app.bloquehorarios.edit')
            ->assertViewHas('bloquehorario');
    }

    /**
     * @test
     */
    public function it_updates_the_bloquehorario()
    {
        $bloquehorario = Bloquehorario::factory()->create();

        $data = [
            'horainicio' => $this->faker->time,
            'horafin' => $this->faker->time,
        ];

        $response = $this->put(
            route('bloquehorarios.update', $bloquehorario),
            $data
        );

        $data['id'] = $bloquehorario->id;

        $this->assertDatabaseHas('bloquehorarios', $data);

        $response->assertRedirect(route('bloquehorarios.edit', $bloquehorario));
    }

    /**
     * @test
     */
    public function it_deletes_the_bloquehorario()
    {
        $bloquehorario = Bloquehorario::factory()->create();

        $response = $this->delete(
            route('bloquehorarios.destroy', $bloquehorario)
        );

        $response->assertRedirect(route('bloquehorarios.index'));

        $this->assertDeleted($bloquehorario);
    }
}
