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
            $table->id()->comment(__('db.users.id'));;
            $table->string('email')->comment(__('db.users.email'))->unique();
            $table->timestamp('email_verified_at')->nullable()->comment(__('db.users.email_verified_at'));
            $table->string('password')->nullable()->comment(__('db.users.password'));
            $table->enum('social', UsersSocial::toArray())->nullable()->comment(__('db.users.social'));
            $table->rememberToken()->comment(__('db.users.remember_token'));
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
