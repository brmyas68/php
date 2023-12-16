<?php

namespace Database\Seeders;

use App\Enums\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
          "code" => randomCode(3),
          "name" => "فاطمه علیزاده",
            "email" => "fatemeh.alzd.faz@gmail.com",
            "username" => "admin",
            "password" => Hash::make("adminAZ79@")
        ];
        $user = User::create($data);
        $user->assignRole(Roles::admin);
    }
}
