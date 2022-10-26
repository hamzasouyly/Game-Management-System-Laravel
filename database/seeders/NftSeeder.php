<?php

namespace Database\Seeders;

use App\Models\Nft;
use Illuminate\Database\Seeder;

class NftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Nft::factory()
            ->count(1)
            ->create();
    }
}
