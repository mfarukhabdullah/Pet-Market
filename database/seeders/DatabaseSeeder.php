<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // USER PROMPT: "yr jitny bhi categories ya breeds banai ha hr aik ki do listings ban kr seeder bna kr add kro with discription details images hr aik breed ki two listings"
        $this->call([
            MarketplaceSeeder::class,
            BreedListingsSeeder::class,
        ]);
    }
}
