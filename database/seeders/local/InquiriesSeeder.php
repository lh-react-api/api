<?php

namespace Database\Seeders\local;

use App\Enums\Inquiries\InquiriesStatus;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InquiriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inquiries')->insert(
            [
                [
                    'id' => 1,
                    'inquiry_type_id' => 1,
                    'email' => 'abcdefg@gmail.com',
                    'text' => '商品の初期不良の件について',
                    'status' => InquiriesStatus::YET,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'id' => 2,
                    'inquiry_type_id' => 2,
                    'email' => 'abcdefg@gmail.com',
                    'text' => 'レンタル商品にswitchを追加して欲しい',
                    'status' => InquiriesStatus::YET,
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
