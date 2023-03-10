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

            $table->id()->comment(__('db.genres.id'));
            $table->string('name', 255)->comment(__('db.genres.name'));
            $table->unsignedBigInteger('upper_id')->nullable()->comment(__('db.genres.upper_id'));
            $table->unsignedInteger('level')->default(1)->comment(__('db.genres.level'));
            $table->text('information')->nullable()->comment(__('db.genres.information'));
            $table->string('image', 512)->nullable()->comment(__('db.genres.image'));

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
