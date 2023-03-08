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
        Schema::create('admin_authorities', function (Blueprint $table) {
            $table->comment('管理権限');

            $table->id()->comment('管理権限ID');
            $table->unsignedBigInteger('admin_user_id')->comment('管理ユーザーID');
            $table->unsignedBigInteger('role_id')->comment('管理権限マスタID');
            $table->unsignedInteger('action')->comment('アクション: "２進数で左からCRUDにする。0101みたいに"');
            
            MigrateUtils::timestamps($table);

            $table->foreign('admin_user_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('admin_users');
            $table->foreign('role_id')->onUpdate('RESTRICT')->onDelete('RESTRICT')->references('id')->on('roles');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_authorities');
    }
};
