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
            $table->enum('settlement_state', PaymentsSettlementState::toArray())->default(PaymentsSettlementState::PROCESSING->value)->comment(__('db.payments.settlement_state'));
            $table->date('payment_date')->comment(__('db.payments.payment_date'));
            
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
        Schema::dropIfExists('payments');
    }
};
