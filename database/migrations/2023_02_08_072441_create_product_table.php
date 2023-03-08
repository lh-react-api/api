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
            $table->boolean('product_type_is_default')->comment('商品種別デフォルトフラグ: 商品詳細画面表示に初回選択状態になる種別に１を設定');
            $table->unsignedInteger('product_rank_priority')->comment('商品ランク優先度: 商品選択時に初回選択状態にする優先度（数値が大きいほど優先度高）');
            $table->string('name', 255)->comment('商品名');
            $table->unsignedInteger('price')->comment('月額料金');
            $table->text('caution_text')->nullable()->comment('注意文言');
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
