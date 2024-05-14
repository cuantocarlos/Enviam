<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory(10)->create();

        User::create([
            'nick' => 'cuantofran',
            'email' => 'fco.carlos@proton.me',
            'password' => bcrypt('a1Ahabxt57wbwdd.'),
            'role' => 'user']);
        User::create([
            'nick' => 'admin',
            'email' => 'fco.carlos@pm.me',
            'password' => bcrypt('a1Ahabxt57wbwdd.'),
            'role' => 'admin',
        ]);

        User::factory(10)->create();
    }
}
