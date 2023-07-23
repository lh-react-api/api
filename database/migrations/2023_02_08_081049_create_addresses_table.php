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

            $table->id()->comment(__('db.addresses.id'));
            $table->unsignedBigInteger('user_id')->comment(__('db.addresses.user_id'));
            $table->string('last_name', 128)->comment(__('db.addresses.last_name'));
            $table->string('last_name_kana', 128)->comment(__('db.addresses.last_name_kana'));
            $table->string('first_name', 128)->comment(__('db.addresses.first_name'));
            $table->string('first_name_kana', 128)->comment(__('db.addresses.first_name_kana'));
            $table->string('post_number', 7)->comment(__('db.addresses.post_number'));
            $table->string('prefecture_name', 8)->comment(__('db.addresses.prefecture_name'));
            $table->string('city', 24)->comment(__('db.addresses.city'));
            $table->string('block', 32)->comment(__('db.addresses.block'));
            $table->string('building', 128)->nullable()->comment(__('db.addresses.building'));
            $table->string('phone_number', 32)->comment(__('db.addresses.phone_number'));
            $table->boolean('is_default')->default(false)->comment(__('db.addresses.is_default'));

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
