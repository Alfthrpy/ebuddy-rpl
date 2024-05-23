<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Position;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user1 = User::create([
            'name' => 'Pegawai1',
            'email' => 'pegawai1@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '123-456-789',
            'role_id' => 3,
            'position_id' => 1,
        ]);
        $user2 = User::create([
            'name' => 'Pejabat1',
            'email' => 'pejabat1@gmail.com',
            'phone' => '124-356-789',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'position_id' => 1,
        ]);
        $user3 = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '143-256-789',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'position_id' => 1,
        ]);

        $position1 = Position::create([
            'name' => 'staff',
        ]);

        $role1 = Role::create([
            'name' => 'Admin',
        ]);
        $role2 = Role::create([
            'name' => 'Pejabat',
        ]);
        $role3 = Role::create([
            'name' => 'Pegawai',
        ]);
    }
}
