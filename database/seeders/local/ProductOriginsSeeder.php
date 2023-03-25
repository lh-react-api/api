<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductOriginsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_origins')->insert(
            [
                [
                    'genre_id' => 1,
                    'maker_id' => 1,
                    'name' => 'PS5',
                    'size' => '20cm * 12cm * 15cm',
                    'weight' => '400g',
                    'release_date' => new Carbon('2023-01-30'),
                    'caution_text' => '商品の注意',
                    'thumbnail' => 'https://smartGarage/images',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'genre_id' => 1,
                    'maker_id' => 2,
                    'name' => 'XBOX',
                    'size' => '120cm * 12cm * 15cm',
                    'weight' => '300g',
                    'release_date' => new Carbon('2022-12-30'),
                    'caution_text' => '商品の注意',
                    'thumbnail' => 'https://smartGarage/images',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'genre_id' => 1,
                    'maker_id' => 1,
                    'name' => 'PS4',
                    'size' => '12cm * 102cm * 15cm',
                    'weight' => '200g',
                    'release_date' => new Carbon('2021-12-30'),
                    'caution_text' => '商品の注意',
                    'thumbnail' => 'https://smartGarage/images',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
