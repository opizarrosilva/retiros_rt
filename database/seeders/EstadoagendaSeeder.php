<?php

namespace Database\Seeders;

use App\Models\Estadoagenda;
use Illuminate\Database\Seeder;

class EstadoagendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estadoagenda::factory()
            ->count(5)
            ->create();
    }
}
