<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('products')->insert([
                'name' => $faker->unique()->word,
                'price' => $faker->numberBetween(10000, 500000),
                'image' => $faker->imageUrl(200, 200, 'fashion'),
                'cate_id' => $faker->numberBetween(1, 2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
}