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
        $this->call([
            UsersTableSeeder::class,
            PlacesTableSeeder::class,
            RolesTableSeeder::class,
            AppointmentsTableSeeder::class,
            HistoriesTableSeeder::class,
            AttachmentsTableSeeder::class,
            RecommendationsTableSeeder::class,
        ]);
    }
}
