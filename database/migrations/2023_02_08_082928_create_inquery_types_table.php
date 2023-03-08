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
        Schema::create('inquery_types', function (Blueprint $table) {
            $table->comment('お問い合わせ種別');

            $table->id()->comment('お問い合わせ種別ID');
            $table->text('text')->comment('お問い合わせ種別名');

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
        Schema::dropIfExists('inquery_types');
    }
};
