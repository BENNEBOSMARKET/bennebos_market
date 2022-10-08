<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::updateOrCreate([
            'name' => 'Admin',
            'avatar' => 'default.jpg',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
