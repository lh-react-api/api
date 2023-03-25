<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductRanksSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


    public function run()
    {
        DB::table('product_ranks')->insert(
            [
                [
                    'rank' => 'S',
                    'information' => '未開封・未使用',
                    'discount_rate' => 1.0,
                    'priority' => 1,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'rank' => 'A',
                    'information' => '美品',
                    'discount_rate' => 0.9,
                    'priority' => 2,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'rank' => 'E',
                    'information' => 'かなり状態が悪い',
                    'discount_rate' => 0.1,
                    'priority' => 3,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
