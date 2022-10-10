<?php

namespace Database\Seeders;

use App\Models\Convocation;
use Illuminate\Database\Seeder;

class ConvocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Convocation::factory()
            ->count(5)
            ->create();
    }
}
