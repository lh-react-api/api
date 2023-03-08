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
        Schema::create('product_ranks', function (Blueprint $table) {
            $table->comment('商品ランク');

            $table->id()->comment('商品ランクID');
            $table->string('rank', 128)->comment('種別名');
            $table->text('information')->nullable()->comment('商品ランク情報');
            $table->float('discount_rate')->comment('割引率: 商品選択時に初回選択状態にする優先度（数値が大きいほど優先度高）');
            $table->unsignedInteger('priority')->comment('優先度');

            MigrateUtils::timestamps($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_ranks');
    }
};
