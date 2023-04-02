<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenrePermissionSeeder extends Seeder
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
                'name' => 'Thể loại',
                'type' => 'group',
                'key_code' => 'genre',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'genre',
                'key_code' => Genre::VIEW,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'genre',
                'key_code' => Genre::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'genre',
                'key_code' => Genre::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'genre',
                'key_code' => Genre::DELETE,
            ],
            [
                'name' => 'Khôi phục',
                'type' => 'genre',
                'key_code' => Genre::RESTORE,
            ],
            [
                'name' => 'Xóa vĩnh viễn',
                'type' => 'genre',
                'key_code' => Genre::FORCE_DELETE,
            ],
        ];

        \DB::table('permissions')->insert($permissions);
    }
}
