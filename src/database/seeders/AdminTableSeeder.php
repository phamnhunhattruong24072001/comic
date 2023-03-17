<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Truong Admin',
            'username' => 'admintruong',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123456'),
            'is_visible' => 1,
        ];
        \DB::table('admins')->insert($data);
    }
}
