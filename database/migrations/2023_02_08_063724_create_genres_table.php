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
        Schema::create('genres', function (Blueprint $table) {
            $table->comment('ジャンルマスタ');

            $table->id()->comment('ジャンルID');
            $table->string('name', 255)->comment('ジャンル名');
            $table->unsignedBigInteger('upper_id')->nullable()->comment('上位階層ジャンルID');
            $table->unsignedInteger('level')->default(1)->comment('階層レベル');
            $table->text('information')->nullable()->comment('ジャンル情報');
            $table->string('image', 512)->nullable()->comment('ジャンルサムネイル画像');

            MigrateUtils::timestamps($table, false);

            $table->foreign('upper_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
};
