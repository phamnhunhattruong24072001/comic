<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryPermissionSeeder extends Seeder
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
                'name' => 'Danh mục',
                'type' => 'group',
                'key_code' => 'category',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'category',
                'key_code' => Category::VIEW,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'category',
                'key_code' => Category::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'category',
                'key_code' => Category::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'category',
                'key_code' => Category::DELETE,
            ],
            [
                'name' => 'Khôi phục',
                'type' => 'category',
                'key_code' => Category::RESTORE,
            ],
            [
                'name' => 'Xóa vĩnh viễn',
                'type' => 'category',
                'key_code' => Category::FORCE_DELETE,
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
