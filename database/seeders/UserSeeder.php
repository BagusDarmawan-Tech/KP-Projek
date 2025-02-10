<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
    

        $admin = User::create([
            'name'  => 'admin',
            'email'  => 'admin@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name'  => 'user',
            'email'  => 'user@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $user->assignRole('user');

        $OPD = User::create([
            'name'  => 'OPD',
            'email'  => 'OPD@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $OPD->assignRole('OPD');

        $kecamatan = User::create([
            'name'  => 'kecamatan',
            'email'  => 'kecamatan@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $kecamatan->assignRole('kecamatan');

        $kelurahan = User::create([
            'name'  => 'kelurahan',
            'email'  => '@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $kelurahan->assignRole('kelurahan');

        $cfci = User::create([
            'name'  => 'cfci',
            'email'  => 'cfci@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $cfci->assignRole('cfci');

        $fas = User::create([
            'name'  => 'fas',
            'email'  => 'fas@gmail.com',
            'password'  => bcrypt('12345')

        ]);
        $fas->assignRole('fas');
    }
}
