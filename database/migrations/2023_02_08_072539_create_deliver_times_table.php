<?php

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
        Schema::create('deliver_times', function (Blueprint $table) {
            $table->comment('配達時間マスタ');

            $table->id()->comment(__('db.deliver_times.id'));
            $table->string('deliver_time', 32)->comment(__('db.deliver_times.deliver_time'));
            $table->unsignedSmallInteger('order')->comment(__('db.deliver_times.order'));
            $table->string('deadline', 32)->comment(__('db.deliver_times.deadline'));

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
        Schema::dropIfExists('deliver_times');
    }
};
