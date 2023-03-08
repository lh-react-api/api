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
        Schema::create('product_origins', function (Blueprint $table) {
            $table->comment('商品原本');

            $table->id()->comment('商品原本ID');
            $table->unsignedBigInteger('genre_id')->comment('ジャンルID');
            $table->unsignedBigInteger('maker_id')->comment('メーカーID');
            $table->string('name', 255)->comment('商品名');
            $table->text('information')->nullable()->comment('商品情報');
            $table->string('size', 255)->nullable()->comment('商品サイズ');
            $table->string('weight', 255)->nullable()->comment('商品重量');
            $table->date('release_date')->nullable()->comment('発売日');
            $table->string('thumbnail', 512)->nullable()->comment('商品サムネイル画像');

            MigrateUtils::timestamps($table);

            $table->foreign('genre_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('genres');
            $table->foreign('maker_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('makers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_origins');
    }
};
