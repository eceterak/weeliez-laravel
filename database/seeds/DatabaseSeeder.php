<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $marek = create(User::class, [
            'name' => 'marek',
            'email' => 'bartula.marek@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('marro2'),
            'remember_token' => '',
            'role' => 1
        ]);
    }
}
