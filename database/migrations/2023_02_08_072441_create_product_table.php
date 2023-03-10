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

            $table->id()->comment(__('db.products.id'));
            $table->unsignedBigInteger('product_origin_id')->comment(__('db.products.product_origin_id'));
            $table->unsignedBigInteger('product_type_id')->comment(__('db.products.product_type_id'));
            $table->unsignedBigInteger('product_rank_id')->comment(__('db.products.product_rank_id'));
            $table->string('name', 255)->comment(__('db.products.name'));
            $table->unsignedInteger('price')->comment(__('db.products.price'));
            $table->string('stripe_plan_id', 255)->comment(__('db.products.stripe_plan_id'));
            $table->enum('status', ProductsStatus::toArray())->comment(__('db.products.status'));

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
