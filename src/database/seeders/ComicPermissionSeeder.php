<?php

namespace Database\Seeders;

use App\Models\Comic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComicPermissionSeeder extends Seeder
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
                'name' => 'Truyện',
                'type' => 'group',
                'key_code' => 'comic',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'comic',
                'key_code' => Comic::VIEW,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'comic',
                'key_code' => Comic::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'comic',
                'key_code' => Comic::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'comic',
                'key_code' => Comic::DELETE,
            ],
            [
                'name' => 'Khôi phục',
                'type' => 'comic',
                'key_code' => Comic::RESTORE,
            ],
            [
                'name' => 'Xóa vĩnh viễn',
                'type' => 'comic',
                'key_code' => Comic::FORCE_DELETE,
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
