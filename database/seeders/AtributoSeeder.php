<?php

namespace Database\Seeders;

use App\Models\Atributo;
use Illuminate\Database\Seeder;

class AtributoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Atributo::factory()
            ->count(5)
            ->create();
    }
}
