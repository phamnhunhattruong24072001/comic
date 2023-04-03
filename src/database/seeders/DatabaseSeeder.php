<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(CategoryPermissionSeeder::class);
        $this->call(CountryPermissionSeeder::class);
        $this->call(GenrePermissionSeeder::class);
        $this->call(ComicPermissionSeeder::class);
        $this->call(ChapterPermissionSeeder::class);
    }
}
