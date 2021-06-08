<?php

namespace Database\Seeders;

use App\Models\Estadoretiro;
use Illuminate\Database\Seeder;

class EstadoretiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estadoretiro::factory()
            ->count(5)
            ->create();
    }
}
