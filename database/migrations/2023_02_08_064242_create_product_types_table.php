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

            $table->id()->comment(__('db.product_types.id'));
            $table->unsignedBigInteger('product_origin_id')->comment(__('db.product_types.product_origin_id'));
            $table->string('name', 255)->comment(__('db.product_types.name'));

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
