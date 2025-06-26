<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Traits\HasRolesAndPermissions;

class UserSeeder extends Seeder
{
    use HasRolesAndPermissions;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'brandinghubwale@gmail.com',
            'mobile' => '1234567890'
        ],
        [
            'name' => 'Admin',
            'email' => 'brandinghubwale@gmail.com',
            'password' => bcrypt('Dh@9016780306'),
            'mobile' => '1234567890'
        ]);

        $admin->assignRole('admin');
        $admin->syncPermissions(array_merge($this->getAllPermissions(), $this->getAdminPermissions()));

    }
}
