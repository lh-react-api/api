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

            $table->id()->comment(__('db.product_reviews.id'));
            $table->unsignedBigInteger('product_origin_id')->comment(__('db.product_reviews.product_origin_id'));
            $table->unsignedBigInteger('product_id')->comment(__('db.product_reviews.product_id'));
            $table->unsignedBigInteger('product_type_id')->comment(__('db.product_reviews.product_type_id'));
            $table->unsignedBigInteger('product_rank_id')->comment(__('db.product_reviews.product_rank_id'));
            $table->unsignedBigInteger('user_id')->comment(__('db.product_reviews.user_id'));
            $table->string('title', 128)->comment(__('db.product_reviews.title'));
            $table->text('text')->comment(__('db.product_reviews.text'));
            $table->unsignedInteger('evaluation')->comment(__('db.product_reviews.evaluation'));

            MigrateUtils::timestamps($table);

            $table->foreign('product_origin_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_origins');
            $table->foreign('product_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('products');
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
