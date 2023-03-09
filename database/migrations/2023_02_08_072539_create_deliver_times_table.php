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

            $table->id()->comment('配達時間マスタID');
            $table->string('deliver_time', 32)->comment('配達時間');
            $table->unsignedSmallInteger('order')->comment('表示順序');
            $table->string('deadline', 32)->comment('受付締切時間');

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
