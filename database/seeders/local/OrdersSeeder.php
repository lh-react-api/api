<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrdersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert(
            [
                [
                    'product_id' => 1,
                    'user_id' => 1,
                    'credit_id' => 1,
                    'progress' => 'YET',
                    'sent_tracking_number' => 'AAAAA-BBBBB-CCCC',
                    'return_tracking_number' => 'XXXXX-YYYYY-ZZZZZ',
                    'settlement_state' => 'PROCESSING',
                    'subscription_id' => 'sub_XXXXX-YYYYY-ZZZZZ',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
