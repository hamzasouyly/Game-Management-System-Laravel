<?php

namespace Database\Seeders;

use App\Models\Sex;
use Illuminate\Database\Seeder;

class SexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sex::factory()
            ->count(1)
            ->create();
    }
}
