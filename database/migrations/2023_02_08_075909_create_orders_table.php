<?php

use App\Enums\Orders\OrdersStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->comment('注文情報');

            $table->id()->comment('注文情報ID');
            $table->unsignedBigInteger('product_id')->comment('商品ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->enum('status', OrdersStatus::toArray())->default(OrdersStatus::YET->value)->comment('状態');
            $table->string('sent_tracking_number', 128)->comment('発送追跡番号');
            $table->string('return_tracking_number', 128)->comment('返送追跡番号');

            MigrateUtils::timestamps($table);

            $table->foreign('product_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('products');
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
        Schema::dropIfExists('orders');
    }
};
