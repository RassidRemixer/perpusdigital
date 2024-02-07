<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role_admin = Role::updateOrcreate(
        //     [
        //         'name' => 'admin'
        //     ],
        //     [   'name' => 'admin']
        // );
        // $role_petugas = Role::updateOrcreate(
        //     [
        //         'name' => 'petugas'
        //     ],
        //     [   'name' => 'petugas']
        // );
        // $role_user = Role::updateOrcreate(
        //     [
        //         'name' => 'user'
        //     ],
        //     [   'name' => 'user']
        // );

        // $permission = Permission::updateOrcreate(
        //     [
        //         'name' => 'create_admin',
        //     ],
        //     ['name' => 'create_admin']
        // );

        // $role_admin ->givePermissionTo($permission);

        
        // $user = User::find(1);

        // $user->assignRole(['admin']);

    }
}
