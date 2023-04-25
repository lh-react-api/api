<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeliverTimesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliver_times')->insert(
            [
                [
                    'deliver_time' => '8:00 ～ 12:00',
                    'order' => 1,
                    'deadline' => '当日7:00まで受付',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'deliver_time' => '14:00 ～ 16:00',
                    'order' => 2,
                    'deadline' => '当日12:40まで受付',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'deliver_time' => '16:00 ～ 18:00',
                    'order' => 3,
                    'deadline' => '当日12:40まで受付',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'deliver_time' => '18:00 ～ 20:00',
                    'order' => 4,
                    'deadline' => '当日17:40まで受付',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'deliver_time' => '19:00 ～ 21:00',
                    'order' => 5,
                    'deadline' => '当日17:40まで受付',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
