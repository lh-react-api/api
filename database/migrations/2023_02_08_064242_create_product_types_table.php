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
        Schema::create('product_types', function (Blueprint $table) {
            $table->comment('商品種別');

            $table->id()->comment('商品種別ID');
            $table->unsignedBigInteger('product_origin_id')->comment('商品原本ID');
            $table->string('name', 255)->comment('種別名');

            MigrateUtils::timestamps($table);

            $table->foreign('product_origin_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('product_origins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_types');
    }
};
