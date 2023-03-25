<?php

namespace Database\Seeders\local;

use App\Enums\Products\ProductsStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        DB::table('products')->insert(
            [
                [
                    'user_id' => 1,
                    'product_origin_id' => 1,
                    'product_type_id' => 1,
                    'product_rank_id' => 1,
                    'name' => '【完品】PS5 デジタルエディション',
                    'price' => 60000,
                    'stripe_plan_id' => 'XXXXXXXXXXX',
                    'status' => ProductsStatus::IN_STOCK,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_origin_id' => 1,
                    'product_type_id' => 1,
                    'product_rank_id' => 2,
                    'name' => '【美品】PS5 デジタルエディション',
                    'price' => 50000,
                    'stripe_plan_id' => 'XXXXXXXXXXX',
                    'status' => ProductsStatus::ON_LEASE,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_origin_id' => 1,
                    'product_type_id' => 1,
                    'product_rank_id' => 3,
                    'name' => '【激安】PS5 デジタルエディション',
                    'price' => 20000,
                    'stripe_plan_id' => 'XXXXXXXXXXX',
                    'status' => ProductsStatus::IN_STOCK,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_origin_id' => 2,
                    'product_type_id' => 3,
                    'product_rank_id' => 1,
                    'name' => '【完品】XBOX 黒',
                    'price' => 30000,
                    'stripe_plan_id' => 'XXXXXXXXXXX',
                    'status' => ProductsStatus::IN_STOCK,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'user_id' => 1,
                    'product_origin_id' => 2,
                    'product_type_id' => 3,
                    'product_rank_id' => 3,
                    'name' => '検索用',
                    'price' => 10000,
                    'stripe_plan_id' => 'XXXXXXXXXXX',
                    'status' => ProductsStatus::IN_STOCK,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
