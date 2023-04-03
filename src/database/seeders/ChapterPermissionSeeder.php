<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChapterPermissionSeeder extends Seeder
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
                'name' => 'Chương truyện',
                'type' => 'group',
                'key_code' => 'chapter',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'chapter',
                'key_code' => Chapter::VIEW,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'chapter',
                'key_code' => Chapter::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'chapter',
                'key_code' => Chapter::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'chapter',
                'key_code' => Chapter::DELETE,
            ],
            [
                'name' => 'Khôi phục',
                'type' => 'chapter',
                'key_code' => Chapter::RESTORE,
            ],
            [
                'name' => 'Xóa vĩnh viễn',
                'type' => 'chapter',
                'key_code' => Chapter::FORCE_DELETE,
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
