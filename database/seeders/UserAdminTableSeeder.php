<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

           User::create([
            'name' => 'administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'level' => 'administrador',
            'cpf' => '000.000.000-00',
            'status' => true,
        ]);
        //

      
    }
}
