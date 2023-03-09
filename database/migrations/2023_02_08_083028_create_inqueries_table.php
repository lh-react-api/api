<?php

use App\Enums\Inquiries\InquiriesDivision;
use App\Enums\Inquiries\InquiriesStatus;
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
        Schema::create('inqueries', function (Blueprint $table) {
            $table->comment('お問い合わせ');

            $table->id()->comment('お問い合わせID');
            $table->unsignedBigInteger('inquery_type_id')->comment('お問合せ種別ID');
            $table->string('email', 256)->comment('連絡用メールアドレス');
            $table->text('text')->comment('お問い合わせ内容');
            $table->enum('status', InquiriesStatus::toArray())->comment('状態');

            MigrateUtils::timestamps($table);

            $table->foreign('inquery_type_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('inquery_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inqueries');
    }
};
