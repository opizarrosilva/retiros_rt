<?php

namespace Database\Seeders;

use App\Models\Retiro;
use Illuminate\Database\Seeder;

class RetiroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Retiro::factory()
            ->count(5)
            ->create();
    }
}
