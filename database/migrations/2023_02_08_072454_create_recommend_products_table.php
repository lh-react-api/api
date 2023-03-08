<?php

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
        Schema::create('recommend_products', function (Blueprint $table) {
            $table->comment('おすすめ商品');

            $table->id()->comment('おすすめ商品ID');
            $table->unsignedBigInteger('products_id')->comment('商品ID');
            $table->unsignedBigInteger('product_image_id')->comment('商品画像ID');

            MigrateUtils::timestamps($table);

            $table->foreign('products_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('products');
            $table->foreign('product_image_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_images');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommend_products');
    }
};
