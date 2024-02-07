<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'petugas', 'guard_name' => 'web'],
            ['name' => 'user', 'guard_name' => 'web'],
        ]);

        $admin = new User();

        $admin->name = "ADMIN";
        $admin->password = bcrypt("password");
        $admin->email = "admin@gmail.com";
        $admin->namalengkap = "BLABLA";
        $admin->alamat = "INDONESIA";
        $admin->role = "admin";
        $admin->save();
        $admin->assignRole('admin');

        $petugas = new User();
        $petugas->name = "PETUGAS";
        $petugas->password = bcrypt("password");
        $petugas->email = "petugas@gmail.com";
        $petugas->namalengkap = "ADADA";
        $petugas->alamat = "dfsfdf";
        $petugas->role = "petugas";
        $petugas->save();
        $petugas->assignRole('petugas');

        $user = new User();
        $user->name = "PEMINJAM";
        $user->password = bcrypt("password");
        $user->email = "peminjam@gmail.com";
        $user->namalengkap = "sdfsfsd";
        $user->alamat = "sdfsdfsd";
        $user->role = "peminjam";
        $user->save();
        $user->assignRole('user');
    }
}
