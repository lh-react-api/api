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

            $table->id()->comment('請求情報ID');
            $table->unsignedBigInteger('order_id')->comment('注文ID');
            $table->string('name', 128)->comment('氏名');
            $table->string('name_kana', 128)->comment('氏名カナ');
            $table->string('post_number', 7)->comment('郵便番号');
            $table->string('prefecture_name', 8)->comment('都道府県');
            $table->string('city', 24)->comment('市区町村');
            $table->string('block', 32)->comment('番地');
            $table->string('building', 128)->nullable()->comment('建物名・部屋番号');
            $table->string('phone_number', 32)->comment('電話番号');
            $table->string('email', 256)->comment('連絡用メールアドレス');

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
