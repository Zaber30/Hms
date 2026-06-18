<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
           'name'=>'zaber',
            'email'=>'alzaberalzaber23@gmail.com',
            'email_verified_at'=>now(),
            'password'=>Hash::make('password'),
            'remember_token'=>Str::random(10),
            'status'=>'approved',
            'role'=>'admin',
        ]);
    }
}
