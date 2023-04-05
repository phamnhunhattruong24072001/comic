<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Việt Nam',
                'slug' => 'viet-nam',
                'another_name' => 'Vietnam',
                'avatar' => 'countries/168061384735.jpg',
                'is_visible' => 1,
            ],
            [
                'name' => 'Hàn quốc',
                'slug' => 'han-quoc',
                'another_name' => 'Korea',
                'avatar' => 'countries/168061384735.jpg',
                'is_visible' => 1,
            ],
            [
                'name' => 'Nhật Bản',
                'slug' => 'nhat-ban',
                'another_name' => 'Japan',
                'avatar' => 'countries/168061384735.jpg',
                'is_visible' => 1,
            ],
        ];
        \DB::table('countries')->insert($data);
    }
}
