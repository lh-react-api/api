<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreditsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credits')->insert(
            [
                [
                    'user_id' => 1,
                    'payments_source' => 'card_1NZCVdDTj4HgVUnillJyPa1b',
                    'status' => 'ENABLE',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'user_id' => 4,
                    'payments_source' => 'pm_1NaITLDTj4HgVUniNzD9Xzgn',
                    'status' => 'ENABLE',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}