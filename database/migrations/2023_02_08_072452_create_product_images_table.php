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
        Schema::create('product_images', function (Blueprint $table) {
            $table->comment('商品画像');

            $table->id()->comment('商品画像ID');
            $table->unsignedBigInteger('products_id')->comment('商品ID');
            $table->string('image', 512)->comment('商品画像');
            $table->unsignedSmallInteger('order')->comment('表示順序');

            MigrateUtils::timestamps($table);

            $table->foreign('products_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
};
