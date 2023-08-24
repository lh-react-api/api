<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddressSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert(
            [
                [
                    'user_id' => 3,
                    'last_name' => '阿部',
                    'last_name_kana' => 'あべ',
                    'first_name' => '慎也',
                    'first_name_kana' => 'しんや',
                    'post_number' => '2000000',
                    'prefecture_name' => '埼玉県',
                    'city' => 'さいたま市',
                    'block' => '岩槻2-11-1',
                    'building' => '建物2',
                    'phone_number' => '090-9999-1111',
                    'is_default' => false,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'user_id' => 4,
                    'last_name' => '須磨跡',
                    'last_name_kana' => 'すまあと',
                    'first_name' => '蛾列絵次',
                    'first_name_kana' => 'がれえじ',
                    'post_number' => '1000000',
                    'prefecture_name' => '東京都',
                    'city' => '品川区',
                    'block' => '南品川2-11-1',
                    'building' => '建物',
                    'phone_number' => '090-9999-9999',
                    'is_default' => true,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],

            ]);
    }
}
