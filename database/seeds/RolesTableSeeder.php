<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'SuperAdmin', 'description' => 'Administrateur Portail']);
        DB::table('roles')->insert(['name' => 'Admin', 'description' => 'Administrateur d\'un client']);
        DB::table('roles')->insert(['name' => 'Utilisateur', 'description' => 'Utilisateur client']);
    }
}
