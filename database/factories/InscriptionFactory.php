<?php

namespace Database\Factories;

use App\Models\Inscription;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class InscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique->uuid,
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'education' => '1',
            'modality' => '1',
            'receipt_path' => $this->faker->text(255),
            'approved' => $this->faker->boolean,
            'convocation_id' => \App\Models\Convocation::factory(),
            'school_id' => \App\Models\School::factory(),
        ];
    }
}
