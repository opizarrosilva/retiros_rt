<?php

namespace Database\Seeders;

use App\Models\Llamado;
use Illuminate\Database\Seeder;

class LlamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Llamado::factory()
            ->count(5)
            ->create();
    }
}
