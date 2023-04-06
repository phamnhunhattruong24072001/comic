<?php

namespace Database\Seeders;

use App\Models\Figure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FigurePermissionSeeder extends Seeder
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
                'name' => 'Nhân vật',
                'type' => 'group',
                'key_code' => 'figure',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'figure',
                'key_code' => Figure::VIEW,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'figure',
                'key_code' => Figure::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'figure',
                'key_code' => Figure::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'figure',
                'key_code' => Figure::DELETE,
            ],
            [
                'name' => 'Khôi phục',
                'type' => 'figure',
                'key_code' => Figure::RESTORE,
            ],
            [
                'name' => 'Xóa vĩnh viễn',
                'type' => 'figure',
                'key_code' => Figure::FORCE_DELETE,
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
