<?php

use App\Enums\Orders\OrdersProgress;
use App\Enums\Orders\OrdersSettlementState;
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

            $table->id()->comment(__('db.orders.id'));
            $table->unsignedBigInteger('product_id')->comment(__('db.orders.product_id'));
            $table->unsignedBigInteger('user_id')->comment(__('db.orders.user_id'));
            $table->unsignedBigInteger('credit_id')->comment(__('db.credits.credit_id'));
            $table->enum('progress', OrdersProgress::toArray())->default(OrdersProgress::YET->value)->comment(__('db.orders.progress'));
            $table->string('sent_tracking_number', 128)->comment(__('db.orders.sent_tracking_number'));
            $table->string('return_tracking_number', 128)->comment(__('db.orders.return_tracking_number'));
            $table->enum('settlement_state', OrdersSettlementState::toArray())->default(OrdersSettlementState::PROCESSING->value)->comment(__('db.orders.settlement_state'));
            $table->string('subscription_id', 128)->comment(__('db.orders.subscription_id'));

            MigrateUtils::timestamps($table);

            $table->foreign('product_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('products');
            $table->foreign('user_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('users');
            $table->foreign('credit_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('credits');

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