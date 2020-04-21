<?php

use Illuminate\Database\Seeder;

class RecommendationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Recommendation::class, 200)->create();
    }
}
