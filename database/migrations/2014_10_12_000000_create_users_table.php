<?php

use App\Enums\Users\UsersSocial;
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
        Schema::create('users', function (Blueprint $table) {
            $table->comment('ユーザテーブル');
            $table->id()->comment('ユーザID');;
            $table->string('email')->comment('メールアドレス')->unique();
            $table->timestamp('email_verified_at')->nullable()->comment('Laravelのメール認証日時');
            $table->string('password')->nullable()->comment('パスワード');
            $table->enum('social', UsersSocial::toArray())->nullable()->comment('ソーシャル認証');
            $table->rememberToken()->comment('Laravel用の認証トークン');
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
        Schema::dropIfExists('users');
    }
};
