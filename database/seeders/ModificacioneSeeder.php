<?php

namespace Database\Seeders;

use App\Models\Modificacione;
use Illuminate\Database\Seeder;

class ModificacioneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modificacione::factory()
            ->count(5)
            ->create();
    }
}
