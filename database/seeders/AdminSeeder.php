<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->name = "Admin";
        $user->lastname = "Admin";
        $user->email = "Admin@gmail.com";
        $user->password = Hash::make('password');
        $user->vat = "12345678901";
        $user->save();
    }
}