<?php

namespace Database\Seeders;

use App\Models\Evidencia;
use Illuminate\Database\Seeder;

class EvidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evidencia::factory()
            ->count(5)
            ->create();
    }
}
