<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Điện thoại',
                'description' => 'Các loại điện thoại mới nhất',
            ],
            [
                'id' => 2,
                'name' => 'Laptop',
                'description' => 'Các dòng laptop mạnh mẽ',
            ],
            [
                'id' => 3,
                'name' => 'Phụ kiện',
                'description' => 'Tai nghe, sạc, ốp lưng và nhiều phụ kiện khác',
            ],
        ]);
    }
}
