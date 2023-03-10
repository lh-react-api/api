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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->comment('配達情報');

            $table->id()->comment(__('db.deliveries.id'));
            $table->unsignedBigInteger('order_id')->comment(__('db.deliveries.order_id'));
            $table->unsignedBigInteger('deliver_time_id')->comment(__('db.deliveries.deliver_time_id'));

            $table->string('name', 128)->comment(__('db.deliveries.name'));
            $table->string('name_kana', 128)->comment(__('db.deliveries.name_kana'));
            $table->string('post_number', 7)->comment(__('db.deliveries.post_number'));
            $table->string('prefecture_name', 8)->comment(__('db.deliveries.prefecture_name'));
            $table->string('city', 24)->comment(__('db.deliveries.city'));
            $table->string('block', 32)->comment(__('db.deliveries.block'));
            $table->string('building', 128)->nullable()->comment(__('db.deliveries.building'));
            $table->string('phone_number', 32)->comment(__('db.deliveries.phone_number'));
            $table->string('email', 256)->comment(__('db.deliveries.email'));


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
        Schema::dropIfExists('deliveries');
    }
};
