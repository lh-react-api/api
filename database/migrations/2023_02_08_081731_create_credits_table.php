<?php

use App\Enums\Credits\CreditsStatus;
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
        Schema::create('credits', function (Blueprint $table) {
            $table->comment('クレジットカード情報テーブル');

            $table->id()->comment(__('db.credits.id'));
            $table->unsignedBigInteger('user_id')->comment(__('db.credits.user_id'));
            $table->string('payments_source', 128)->comment(__('db.credits.payments_source'));
            $table->enum('status', CreditsStatus::toArray())->default(CreditsStatus::ENABLE->value)->comment(__('db.credits.status'));

            MigrateUtils::timestamps($table);

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
        Schema::dropIfExists('credits');
    }
};
