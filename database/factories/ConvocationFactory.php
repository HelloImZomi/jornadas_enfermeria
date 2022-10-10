<?php

namespace Database\Factories;

use App\Models\Convocation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConvocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Convocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
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
    }
}
