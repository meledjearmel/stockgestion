<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'lastname' => 'Super',
            'email' => 'super@admin.fr',
            'username' => 'admin',
            'password' => Hash::make('stockgestion'),
            'level' => 1,
            'sex' => 'Masculin',
            'contact' => '(225) 55-555-555',
        ]);
    }
}
