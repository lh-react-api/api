<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoticesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->insert(
            [
                [
                    'division' => 'IMPORTANT',
                    'title' => '重要お知らせ',
                    'text' => '重要お知らせです',
                    'notice_date' => '2023-01-01',
                    'close_date' => '2023-12-31',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'division' => 'NOTICE',
                    'title' => '通常お知らせ',
                    'text' => '通常お知らせです',
                    'notice_date' => '2023-01-01',
                    'close_date' => '2023-12-31',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
