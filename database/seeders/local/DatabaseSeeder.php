<?php

namespace Database\Seeders\local;

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
        $this->call(UsersSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(CreditsSeeder::class);
        $this->call(MakersSeeder::class);
        $this->call(GenresSeeder::class);
        $this->call(ProductOriginsSeeder::class);
        $this->call(ProductTypesSeeder::class);
        $this->call(ProductRanksSeeder::class);
        $this->call(ProductsSeeder::class);


    }
}
