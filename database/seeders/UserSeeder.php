<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role  = Role::where('id', '1')->first();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role_id' => $admin_role->id,
            'password' => Hash::make('password'),
        ]);
    }
}
