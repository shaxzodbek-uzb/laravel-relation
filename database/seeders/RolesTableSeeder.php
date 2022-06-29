<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            ['name' => 'Admin'],
            ['name' => 'Operator'],
        ];

        foreach ($data as $item) {
            \App\Models\Role::create($item);
        }

        $data = [
            ['name' => 'create products'],
            ['name' => 'products index'],
        ];

        foreach ($data as $item) {
            \App\Models\Permission::create($item);
        }

        $adminRole = \App\Models\Role::where('name', 'Admin')->first();

        $adminRole->permissions()->sync(\App\Models\Permission::all());
    }
}
