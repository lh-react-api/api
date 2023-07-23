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
        Schema::create('delivers', function (Blueprint $table) {
            $table->comment('配達情報');

            $table->id()->comment(__('db.delivers.id'));
            $table->unsignedBigInteger('order_id')->comment(__('db.delivers.order_id'));
            $table->unsignedBigInteger('deliver_time_id')->comment(__('db.delivers.deliver_time_id'));
            $table->string('last_name', 128)->comment(__('db.delivers.last_name'));
            $table->string('last_name_kana', 128)->comment(__('db.delivers.last_name_kana'));
            $table->string('first_name', 128)->comment(__('db.delivers.first_name'));
            $table->string('first_name_kana', 128)->comment(__('db.delivers.first_name_kana'));
            $table->string('post_number', 7)->comment(__('db.delivers.post_number'));
            $table->string('prefecture_name', 8)->comment(__('db.delivers.prefecture_name'));
            $table->string('city', 24)->comment(__('db.delivers.city'));
            $table->string('block', 32)->comment(__('db.delivers.block'));
            $table->string('building', 128)->nullable()->comment(__('db.delivers.building'));
            $table->string('phone_number', 32)->comment(__('db.delivers.phone_number'));
            $table->string('email', 256)->comment(__('db.delivers.email'));


            MigrateUtils::timestamps($table);

            $table->foreign('order_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('orders');
            $table->foreign('deliver_time_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('deliver_times');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivers');
    }
};
