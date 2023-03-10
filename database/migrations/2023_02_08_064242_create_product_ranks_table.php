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

            $table->id()->comment(__('db.product_ranks.id'));
            $table->string('rank', 128)->comment(__('db.product_ranks.rank'));
            $table->text('information')->nullable()->comment(__('db.product_ranks.information'));
            $table->float('discount_rate')->comment(__('db.product_ranks.discount_rate'));
            $table->unsignedInteger('priority')->comment(__('db.product_ranks.priority'));

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
