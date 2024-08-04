<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $OwnerRole = Role::create(['name' => 'Owner']);

        $pembeliRole = Role::create(['name' => 'Pembeli']);

        $user = User::create([
            'name' => 'Owner Apotek',
            'email' => 'ownerapotek@owner.com',
            'password' => bcrypt('123'),
        ]);
        $user->assignRole($OwnerRole);
    }
}
