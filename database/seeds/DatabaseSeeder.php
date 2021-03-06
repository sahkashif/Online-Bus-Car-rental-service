<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(StationSeeder::class);
        $this->call(VechicleSeeder::class);
        $this->call(RouteSeeder::class);
    }
}
