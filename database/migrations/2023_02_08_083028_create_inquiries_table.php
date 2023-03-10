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
        Schema::create('inquiries', function (Blueprint $table) {
            $table->comment('お問い合わせ');

            $table->id()->comment(__('db.inquiries.id'));
            $table->unsignedBigInteger('inquiry_type_id')->comment(__('db.inquiries.inquiry_type_id'));
            $table->string('email', 256)->comment(__('db.inquiries.email'));
            $table->text('text')->comment(__('db.inquiries.text'));
            $table->enum('status', InquiriesStatus::toArray())->comment(__('db.inquiries.status'));

            MigrateUtils::timestamps($table);

            $table->foreign('inquiry_type_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('inquiry_types');

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
