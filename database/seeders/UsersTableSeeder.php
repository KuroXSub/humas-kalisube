<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Petugas Satu',
                'email' => 'petugas1@example.com',
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Petugas Dua',
                'email' => 'petugas2@example.com',
                'password' => Hash::make('password'),
                'role' => 'petugas',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Satu',
                'email' => 'masyarakat1@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Dua',
                'email' => 'masyarakat2@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Tiga',
                'email' => 'masyarakat3@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Empat',
                'email' => 'masyarakat4@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Lima',
                'email' => 'masyarakat5@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Enam',
                'email' => 'masyarakat6@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Tujuh',
                'email' => 'masyarakat7@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Delapan',
                'email' => 'masyarakat8@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Sembilan',
                'email' => 'masyarakat9@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Sepuluh',
                'email' => 'masyarakat10@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Sebelas',
                'email' => 'masyarakat11@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Masyarakat Duabelas',
                'email' => 'masyarakat12@example.com',
                'password' => Hash::make('password'),
                'role' => 'masyarakat',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}