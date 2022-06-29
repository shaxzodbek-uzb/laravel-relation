<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Admin'],
            ['name' => 'Operator'],
        ];

        foreach ($data as $item) {
            Role::findOrCreate($item['name']);
        }

        $data = [
            ['name' => 'create-products'],
            ['name' => 'index-products'],
            ['name' => 'show-products'],
            ['name' => 'update-products'],
            ['name' => 'edit-products'],
        ];

        foreach ($data as $item) {
            Permission::findOrCreate($item['name']);
        }

        $adminRole = Role::where('name', 'Admin')->first();

        $adminRole->syncPermissions(Permission::all());
    }
}
