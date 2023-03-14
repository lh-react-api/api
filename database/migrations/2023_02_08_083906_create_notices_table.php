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

            $table->id()->comment(__('db.notices.id'));
            $table->enum('division', NoticesDivision::toArray())->default(NoticesDivision::NOTICE->value)->comment(__('db.notices.division'));
            $table->string('title', 128)->comment(__('db.notices.title'));
            $table->text('text')->comment(__('db.notices.text'));
            $table->date('notice_date')->nullable()->comment(__('db.notices.notice_date'));
            $table->date('close_date')->nullable()->comment(__('db.notices.close_date'));

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
