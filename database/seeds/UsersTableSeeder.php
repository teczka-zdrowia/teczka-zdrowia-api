<?php

use App\Storage;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function ($user, $key) {
            if ($user->isPaymentValid($user)) {
                Storage::create(['user_id' => $user->id, 'kb_max' => 100000]);
            }
        });
    }
}
