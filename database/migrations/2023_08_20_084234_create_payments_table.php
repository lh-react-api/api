<?php

use App\Enums\Payments\PaymentsSettlementState;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->comment('決済情報');

            $table->id()->comment(__('db.payments.id'));
            $table->unsignedBigInteger('order_id')->comment(__('db.payments.order_id'));
            $table->unsignedBigInteger('credit_id')->comment(__('db.credits.credit_id'));
            $table->enum('settlement_state', PaymentsSettlementState::toArray())->default(PaymentsSettlementState::SUCCESS->value)->comment(__('db.payments.settlement_state'));
            
            MigrateUtils::timestamps($table);

            $table->foreign('order_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('orders');
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
        Schema::dropIfExists('payments');
    }
};
