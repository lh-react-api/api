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
        Schema::create('demands', function (Blueprint $table) {
            $table->comment('請求情報');

            $table->id()->comment(__('db.demands.id'));
            $table->unsignedBigInteger('order_id')->comment(__('db.demands.order_id'));
            $table->string('name', 128)->comment(__('db.demands.name'));
            $table->string('name_kana', 128)->comment(__('db.demands.name_kana'));
            $table->string('post_number', 7)->comment(__('db.demands.post_number'));
            $table->string('prefecture_name', 8)->comment(__('db.demands.prefecture_name'));
            $table->string('city', 24)->comment(__('db.demands.city'));
            $table->string('block', 32)->comment(__('db.demands.block'));
            $table->string('building', 128)->nullable()->comment(__('db.demands.building'));
            $table->string('phone_number', 32)->comment(__('db.demands.phone_number'));
            $table->string('email', 256)->comment(__('db.demands.email'));

            MigrateUtils::timestamps($table);

            $table->foreign('order_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demands');
    }
};
