<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Convocation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConvocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_convocations()
    {
        $convocations = Convocation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('convocations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.convocations.index')
            ->assertViewHas('convocations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_convocation()
    {
        $response = $this->get(route('convocations.create'));

        $response->assertOk()->assertViewIs('app.convocations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_convocation()
    {
        $data = Convocation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('convocations.store'), $data);

        unset($data['is_visible']);

        $this->assertDatabaseHas('convocations', $data);

        $convocation = Convocation::latest('id')->first();

        $response->assertRedirect(route('convocations.edit', $convocation));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_convocation()
    {
        $convocation = Convocation::factory()->create();

        $response = $this->get(route('convocations.show', $convocation));

        $response
            ->assertOk()
            ->assertViewIs('app.convocations.show')
            ->assertViewHas('convocation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_convocation()
    {
        $convocation = Convocation::factory()->create();

        $response = $this->get(route('convocations.edit', $convocation));

        $response
            ->assertOk()
            ->assertViewIs('app.convocations.edit')
            ->assertViewHas('convocation');
    }

    /**
     * @test
     */
    public function it_updates_the_convocation()
    {
        $convocation = Convocation::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'inscription_start_date' => $this->faker->date,
            'inscription_end_date' => $this->faker->date,
            'start_time' => $this->faker->dateTime('now', 'UTC'),
            'end_time' => $this->faker->dateTime('now', 'UTC'),
            'presencial_limit' => $this->faker->randomNumber,
            'virtual_limit' => $this->faker->randomNumber,
            'zoom_url' => $this->faker->text(255),
            'whatsapp_url' => $this->faker->text(255),
            'logo_path' => $this->faker->text(255),
            'is_visible' => $this->faker->boolean,
        ];

        $response = $this->put(
            route('convocations.update', $convocation),
            $data
        );

        unset($data['is_visible']);

        $data['id'] = $convocation->id;

        $this->assertDatabaseHas('convocations', $data);

        $response->assertRedirect(route('convocations.edit', $convocation));
    }

    /**
     * @test
     */
    public function it_deletes_the_convocation()
    {
        $convocation = Convocation::factory()->create();

        $response = $this->delete(route('convocations.destroy', $convocation));

        $response->assertRedirect(route('convocations.index'));

        $this->assertModelMissing($convocation);
    }
}
