<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReviewsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_reviews')->insert(
            [
                [
                    'product_id' => 1,
                    'user_id' => 1,
                    'title' => '最高評価レビュー',
                    'text' => '最高評価',
                    'evaluation' => 5,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'products_id' => 1,
                    'user_id' => 1,
                    'title' => '高評価レビュー',
                    'text' => '高評価',
                    'evaluation' => 4,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'products_id' => 1,
                    'user_id' => 1,
                    'title' => '通常評価レビュー',
                    'text' => '通常評価',
                    'evaluation' => 3,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'products_id' => 1,
                    'user_id' => 1,
                    'title' => '低評価レビュー',
                    'text' => '低評価',
                    'evaluation' => 2,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'products_id' => 1,
                    'user_id' => 1,
                    'title' => '最低評価レビュー',
                    'text' => '最低評価',
                    'evaluation' => 1,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
