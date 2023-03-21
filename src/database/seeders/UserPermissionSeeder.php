<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserPermissionSeeder extends Seeder
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
             'name' => 'Người dùng',
             'type' => 'group',
             'key_code' => 'user',
           ],
           [
            'name' => 'Danh sách',
            'type' => 'user',
            'key_code' => User::VIEW,
          ],
          [
            'name' => 'Thêm mới',
            'type' => 'user',
            'key_code' => User::CREATE,
          ],
          [
            'name' => 'Cập nhật',
            'type' => 'user',
            'key_code' => User::UPDATE,
          ],
          [
            'name' => 'Xóa',
            'type' => 'user',
            'key_code' => User::DELETE,
          ],
          [
            'name' => 'Khôi phục',
            'type' => 'user',
            'key_code' => User::RESTORE,
          ],
          [
            'name' => 'Xóa vĩnh viễn',
            'type' => 'user',
            'key_code' => User::FORCE_DELETE,
          ],
        ];

        \DB::table('permissions')->insert($permissions);
    }
}
