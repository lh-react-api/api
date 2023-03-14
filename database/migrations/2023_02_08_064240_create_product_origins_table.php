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

            $table->id()->comment(__('db.product_origins.id'));
            $table->unsignedBigInteger('genre_id')->comment(__('db.product_origins.genre_id'));
            $table->unsignedBigInteger('maker_id')->comment(__('db.product_origins.maker_id'));
            $table->string('name', 255)->comment(__('db.product_origins.name'));
            $table->text('information')->nullable()->comment(__('db.product_origins.information'));
            $table->text('caution_text')->nullable()->comment(__('db.product_origins.caution_text'));
            $table->string('size', 255)->nullable()->comment(__('db.product_origins.size'));
            $table->string('weight', 255)->nullable()->comment(__('db.product_origins.weight'));
            $table->date('release_date')->nullable()->comment(__('db.product_origins.release_date'));
            $table->string('thumbnail', 512)->nullable()->comment(__('db.product_origins.thumbnail'));

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
