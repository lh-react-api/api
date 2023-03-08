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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->comment('商品レビュー');

            $table->id()->comment('商品レビューID');
            $table->unsignedBigInteger('product_origin_id')->comment('商品原本ID');
            $table->unsignedBigInteger('product_type_id')->comment('商品種別ID');
            $table->unsignedBigInteger('product_rank_id')->comment('商品ランクID');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');

            $table->string('title', 128)->comment('タイトル');
            $table->text('text')->comment('レビュー内容');
            $table->unsignedInteger('evaluation')->comment('評価');

            MigrateUtils::timestamps($table);

            $table->foreign('product_origin_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_origins');
            $table->foreign('product_type_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_types');
            $table->foreign('product_rank_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_ranks');
            $table->foreign('user_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_reviews');
    }
};
