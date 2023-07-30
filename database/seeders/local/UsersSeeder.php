<?php

namespace Database\Seeders\local;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'email' => 'admin@sg.sandbox',
                    'email_verified_at' => null,
                    'password' => Hash::make('pass'),//pass
                    'social' => null,
                    'remember_token' => null,
                    'is_admin' => true,
                    'stripe_customer_id' => 'cus_OLtoiQItILazls',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'email' => 'ishikawa@sg.sandbox',
                    'email_verified_at' => null,
                    'password' => Hash::make('pass'),//pass
                    'social' => null,
                    'remember_token' => null,
                    'is_admin' => false,
                    'stripe_customer_id' => 'cus_OLtq3MbX0IVdeN',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'email' => 'shi_abe@tale-jp.com',
                    'email_verified_at' => null,
                    'password' => Hash::make('hke6ynp*frv5pxh@THA'),//pass
                    'social' => null,
                    'remember_token' => null,
                    'is_admin' => false,
                    'stripe_customer_id' => 'cus_OCB8lC02VeDiis',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
                [
                    'email' => 'smagare@sg.sandbox',
                    'email_verified_at' => null,
                    'password' => Hash::make('pass'),//pass
                    'social' => null,
                    'remember_token' => null,
                    'is_admin' => false,
                    'stripe_customer_id' => 'cus_OLtr1EeqEbNtmw',
                    'created_at' => Carbon::now(),
                    'created_by' => 1,
                    'updated_at' => Carbon::now(),
                    'updated_by' => 1,
                ],
            ]);
    }
}
