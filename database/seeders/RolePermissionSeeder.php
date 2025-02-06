<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name'=>'list']);
        Permission::create(['name'=>'look']);
        Permission::create(['name'=>'add']);
        Permission::create(['name'=>'edit']);
        Permission::create(['name'=>'delete']);
        Permission::create(['name'=>'verifikasi']);
        Permission::create(['name'=>'excel']);

        Role::create([('name')=>'developer']);
        Role::create([('name')=>'admin']);
        Role::create([('name')=>'user']);
        Role::create([('name')=>'OPD']);
        Role::create([('name')=>'kecamatan']);
        Role::create([('name')=>'kelurahan']);
        Role::create([('name')=>'cfci']);
        Role::create([('name')=>'fas']);

        $roleDeveloper = Role::findByName('developer');
        $roleDeveloper->givePermissionTo('list');
        $roleDeveloper->givePermissionTo('look');
        $roleDeveloper->givePermissionTo('add');
        $roleDeveloper->givePermissionTo('edit');
        $roleDeveloper->givePermissionTo('delete');
        $roleDeveloper->givePermissionTo('verifikasi');
        $roleDeveloper->givePermissionTo('excel');

        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('list');
        $roleAdmin->givePermissionTo('look');
        $roleAdmin->givePermissionTo('add');
        $roleAdmin->givePermissionTo('edit');
        $roleAdmin->givePermissionTo('delete');

        $roleOPD = Role::findByName('OPD');
        $roleOPD->givePermissionTo('list');
        $roleOPD->givePermissionTo('look');
        $roleOPD->givePermissionTo('add');
      
        $roleKecamatan = Role::findByName('kecamatan');
        $roleKecamatan->givePermissionTo('list');
        $roleKecamatan->givePermissionTo('look');
        $roleKecamatan->givePermissionTo('add');

        $roleKelurahan = Role::findByName('kelurahan');
        $roleKelurahan->givePermissionTo('list');
        $roleKelurahan->givePermissionTo('look');
        $roleKelurahan->givePermissionTo('add');

        $roleFas = Role::findByName('fas');
        $roleFas->givePermissionTo('list');
        $roleFas->givePermissionTo('look');
        $roleFas->givePermissionTo('add');

        $roleCfci = Role::findByName('cfci');
        $roleCfci->givePermissionTo('list');
        $roleCfci->givePermissionTo('look');
        $roleCfci->givePermissionTo('add');

        $roleUser = Role::findByName('user');
        $roleUser->givePermissionTo('list');
        $roleUser->givePermissionTo('look');
    }
}
