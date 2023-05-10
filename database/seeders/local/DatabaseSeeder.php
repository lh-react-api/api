<?php

namespace Database\Seeders\local;

use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(CreditsSeeder::class);
        $this->call(MakersSeeder::class);
        $this->call(GenresSeeder::class);
        $this->call(ProductOriginsSeeder::class);
        $this->call(ProductTypesSeeder::class);
        $this->call(ProductRanksSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(InquiryTypesSeeder::class);
        $this->call(InquiriesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminAuthoritiesSeeder::class);
        $this->call(ProductImagesSeeder::class);
        $this->call(RecommendProductsSeeder::class);
        $this->call(ProductReviewsSeeder::class);
        $this->call(OrdersSeeder::class);
        $this->call(NoticesSeeder::class);
        $this->call(DemandsSeeder::class);
        $this->call(DeliverTimesSeeder::class);
        $this->call(DeliversSeeder::class);
    }
}
