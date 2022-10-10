<?php

namespace Database\Seeders;

use App\Models\Inscription;
use Illuminate\Database\Seeder;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inscription::factory()
            ->count(5)
            ->create();
    }
}
