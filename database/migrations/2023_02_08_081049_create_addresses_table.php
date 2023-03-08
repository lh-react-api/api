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
        Schema::create('addresses', function (Blueprint $table) {
            $table->comment('住所');

            $table->id()->comment('住所ID');
            $table->unsignedBigInteger('user_id')->comment('ユーザID');
            $table->string('last_name', 128)->comment('姓');
            $table->string('last_name_kana', 128)->comment('姓かな');
            $table->string('first_name', 128)->comment('名');
            $table->string('first_name_kana', 128)->comment('名かな');
            $table->string('post_number', 7)->comment('郵便番号');
            $table->string('prefecture_name', 8)->comment('都道府県');
            $table->string('city', 24)->comment('市区町村');
            $table->string('block', 32)->comment('番地');
            $table->string('building', 128)->nullable()->comment('建物名・部屋番号');
            $table->boolean('is_default')->default(false)->comment('デフォルトフラグ');

            MigrateUtils::timestamps($table);

            $table->foreign('user_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
