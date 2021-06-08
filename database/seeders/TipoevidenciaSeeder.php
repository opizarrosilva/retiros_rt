<?php

namespace Database\Seeders;

use App\Models\Tipoevidencia;
use Illuminate\Database\Seeder;

class TipoevidenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipoevidencia::factory()
            ->count(5)
            ->create();
    }
}
