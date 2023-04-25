<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemandsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('demands')->insert(
            [
                [
                    'order_id' => 1,
                    'name' => '石川',
                    'name_kana' => 'いしかわ',
                    'post_number' => '1000000',
                    'prefecture_name' => '東京都',
                    'city' => '品川区',
                    'block' => '南品川2-11-1',
                    'building' => '建物',
                    'phone_number' => '090-9999-9999',
                    'email' => 'otamesi@gmail.com',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'order_id' => 1,
                    'name' => '石川2',
                    'name_kana' => 'いしかわ2',
                    'post_number' => '1000000',
                    'prefecture_name' => '東京都',
                    'city' => '品川区',
                    'block' => '南品川2-11-1',
                    'building' => '建物',
                    'phone_number' => '090-9999-9999',
                    'email' => 'otamesi@yahoo.co.jp',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
