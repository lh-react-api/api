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

            $table->id()->comment(__('db.product_images.id'));
            $table->unsignedBigInteger('product_id')->comment(__('db.product_images.product_id'));
            $table->string('image', 512)->comment(__('db.product_images.image'));
            $table->unsignedSmallInteger('order')->comment(__('db.product_images.order'));

            MigrateUtils::timestamps($table);

            $table->foreign('product_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('products');

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
