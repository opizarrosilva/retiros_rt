<?php

namespace Database\Seeders;

use App\Models\Estadollamado;
use Illuminate\Database\Seeder;

class EstadollamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estadollamado::factory()
            ->count(5)
            ->create();
    }
}
