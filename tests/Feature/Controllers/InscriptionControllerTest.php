<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Inscription;

use App\Models\School;
use App\Models\Convocation;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InscriptionControllerTest extends TestCase
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
    public function it_displays_index_view_with_inscriptions()
    {
        $inscriptions = Inscription::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('inscriptions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.inscriptions.index')
            ->assertViewHas('inscriptions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_inscription()
    {
        $response = $this->get(route('inscriptions.create'));

        $response->assertOk()->assertViewIs('app.inscriptions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_inscription()
    {
        $data = Inscription::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('inscriptions.store'), $data);

        $this->assertDatabaseHas('inscriptions', $data);

        $inscription = Inscription::latest('id')->first();

        $response->assertRedirect(route('inscriptions.edit', $inscription));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_inscription()
    {
        $inscription = Inscription::factory()->create();

        $response = $this->get(route('inscriptions.show', $inscription));

        $response
            ->assertOk()
            ->assertViewIs('app.inscriptions.show')
            ->assertViewHas('inscription');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_inscription()
    {
        $inscription = Inscription::factory()->create();

        $response = $this->get(route('inscriptions.edit', $inscription));

        $response
            ->assertOk()
            ->assertViewIs('app.inscriptions.edit')
            ->assertViewHas('inscription');
    }

    /**
     * @test
     */
    public function it_updates_the_inscription()
    {
        $inscription = Inscription::factory()->create();

        $convocation = Convocation::factory()->create();
        $school = School::factory()->create();

        $data = [
            'code' => $this->faker->unique->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'education' => '1',
            'modality' => '1',
            'receipt_path' => $this->faker->text(255),
            'approved' => $this->faker->boolean,
            'convocation_id' => $convocation->id,
            'school_id' => $school->id,
        ];

        $response = $this->put(
            route('inscriptions.update', $inscription),
            $data
        );

        $data['id'] = $inscription->id;

        $this->assertDatabaseHas('inscriptions', $data);

        $response->assertRedirect(route('inscriptions.edit', $inscription));
    }

    /**
     * @test
     */
    public function it_deletes_the_inscription()
    {
        $inscription = Inscription::factory()->create();

        $response = $this->delete(route('inscriptions.destroy', $inscription));

        $response->assertRedirect(route('inscriptions.index'));

        $this->assertModelMissing($inscription);
    }
}
