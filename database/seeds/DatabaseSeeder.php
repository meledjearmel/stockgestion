<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@admin.fr',
            'username' => 'admin',
            'password' => Hash::make('stockgestion'),
            'level' => 1,
            'sex' => 'Masculin',
            'contact' => '(225) 55-555-555',
        ]);

        $role = Role::create(['name' => 'admin']);
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'seller']);

        $user->assignRole($role);
    }
}
