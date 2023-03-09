<?php

use App\Enums\Notices\NoticesDivision;
use App\Enums\Notices\NoticesStatus;
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
        Schema::create('notices', function (Blueprint $table) {
            $table->comment('お知らせ');

            $table->id()->comment('お知らせID');

            $table->enum('division', NoticesDivision::toArray())->default(NoticesDivision::NOTICE->value)->comment('区分');
            $table->string('title', 128)->comment('タイトル');
            $table->text('text')->comment('お知らせ内容');
            $table->date('notice_date')->nullable()->comment('公開日');
            $table->date('close_date')->nullable()->comment('終了日');

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
        Schema::dropIfExists('notices');
    }
};
