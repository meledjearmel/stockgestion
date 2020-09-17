<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $role = Role::create(['name' => 'admin']); // Super Administrateur
                Role::create(['name' => 'manager']); // Manager de stock d'un point de vente
                Role::create(['name' => 'seller']); // Vendeur d'un point de vente
                Role::create(['name' => 'deliverer']); // Livreur
                Role::create(['name' => 'surface-technician']); // Technicien de surface
                Role::create(['name' => 'accountant']); // Comptable
                Role::create(['name' => 'logistics-manager']); // Responsable logistique
                Role::create(['name' => 'agency-manager']); // Chef d'agence

        $user->assignRole($role);
    }
}
