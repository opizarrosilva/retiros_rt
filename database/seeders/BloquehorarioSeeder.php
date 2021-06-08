<?php

namespace Database\Seeders;

use App\Models\Bloquehorario;
use Illuminate\Database\Seeder;

class BloquehorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bloquehorario::factory()
            ->count(5)
            ->create();
    }
}
