<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountryPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'Quốc gia',
                'type' => 'group',
                'key_code' => 'country',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'country',
                'key_code' => Country::VIEW,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'country',
                'key_code' => Country::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'country',
                'key_code' => Country::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'country',
                'key_code' => Country::DELETE,
            ],
            [
                'name' => 'Khôi phục',
                'type' => 'country',
                'key_code' => Country::RESTORE,
            ],
            [
                'name' => 'Xóa vĩnh viễn',
                'type' => 'country',
                'key_code' => Country::FORCE_DELETE,
            ],
        ];

        \DB::table('permissions')->insert($permissions);
    }
}
