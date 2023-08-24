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
        Schema::create('product_type_images', function (Blueprint $table) {
            $table->comment('商品タイプ画像');
            $table->id()->comment(__('db.product_type_images.id'));
            $table->unsignedBigInteger('product_type_id')->comment(__('db.product_type_images.product_type_id'));
            $table->string('image', 512)->comment(__('db.product_type_images.image'));
            $table->unsignedSmallInteger('order')->comment(__('db.product_type_images.order'));

            MigrateUtils::timestamps($table);

            $table->foreign('product_type_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_types');

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
