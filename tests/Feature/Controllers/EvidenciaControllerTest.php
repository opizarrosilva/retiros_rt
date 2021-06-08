<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Evidencia;

use App\Models\Retiro;
use App\Models\Tipoevidencia;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EvidenciaControllerTest extends TestCase
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
    public function it_displays_index_view_with_evidencias()
    {
        $evidencias = Evidencia::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('evidencias.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.evidencias.index')
            ->assertViewHas('evidencias');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_evidencia()
    {
        $response = $this->get(route('evidencias.create'));

        $response->assertOk()->assertViewIs('app.evidencias.create');
    }

    /**
     * @test
     */
    public function it_stores_the_evidencia()
    {
        $data = Evidencia::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('evidencias.store'), $data);

        $this->assertDatabaseHas('evidencias', $data);

        $evidencia = Evidencia::latest('id')->first();

        $response->assertRedirect(route('evidencias.edit', $evidencia));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_evidencia()
    {
        $evidencia = Evidencia::factory()->create();

        $response = $this->get(route('evidencias.show', $evidencia));

        $response
            ->assertOk()
            ->assertViewIs('app.evidencias.show')
            ->assertViewHas('evidencia');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_evidencia()
    {
        $evidencia = Evidencia::factory()->create();

        $response = $this->get(route('evidencias.edit', $evidencia));

        $response
            ->assertOk()
            ->assertViewIs('app.evidencias.edit')
            ->assertViewHas('evidencia');
    }

    /**
     * @test
     */
    public function it_updates_the_evidencia()
    {
        $evidencia = Evidencia::factory()->create();

        $retiro = Retiro::factory()->create();
        $tipoevidencia = Tipoevidencia::factory()->create();
        $user = User::factory()->create();

        $data = [
            'url' => $this->faker->text(255),
            'retiro_id' => $retiro->id,
            'tipoevidencia_id' => $tipoevidencia->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('evidencias.update', $evidencia), $data);

        $data['id'] = $evidencia->id;

        $this->assertDatabaseHas('evidencias', $data);

        $response->assertRedirect(route('evidencias.edit', $evidencia));
    }

    /**
     * @test
     */
    public function it_deletes_the_evidencia()
    {
        $evidencia = Evidencia::factory()->create();

        $response = $this->delete(route('evidencias.destroy', $evidencia));

        $response->assertRedirect(route('evidencias.index'));

        $this->assertDeleted($evidencia);
    }
}
