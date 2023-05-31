<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GenresSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert(
            [
                [
                    'name' => '電子機器',
                    'parent_id' => null,
                    'position' => 1,
                    'information' => '電子機器全般（これがジャンル分けの正ではないよ）',
                    'image' => 'https://smartGarage/images',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'name' => 'ゲーム機',
                    'parent_id' => 1,
                    'position' => 2,
                    'information' => '家庭用ゲーム機',
                    'image' => 'https://smartGarage/images',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
