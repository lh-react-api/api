<?php

use App\Enums\Products\ProductsStatus;
use App\Utilities\MigrateUtils;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->comment('商品');

            $table->id()->comment('商品ID');
            $table->unsignedBigInteger('product_origin_id')->comment('商品原本ID');
            $table->unsignedBigInteger('product_type_id')->comment('商品種別ID');
            $table->unsignedBigInteger('product_rank_id')->comment('商品ランクID');
            $table->string('name', 255)->comment('商品名');
            $table->unsignedInteger('price')->comment('月額料金');
            $table->string('stripe_plan_id', 255)->comment('stripeプランID');
            $table->enum('status', ProductsStatus::toArray())->comment('ステータス');

            MigrateUtils::timestamps($table);

            $table->foreign('product_origin_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_origins');
            $table->foreign('product_type_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_types');
            $table->foreign('product_rank_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_ranks');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
