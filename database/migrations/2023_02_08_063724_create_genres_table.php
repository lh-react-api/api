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
            $table->unsignedBigInteger('parent_id')->nullable()->comment(__('db.genres.parent_id'));
            $table->integer('position', false, true)->comment(__('db.genres.level'));
            $table->text('information')->nullable()->comment(__('db.genres.information'));
            $table->string('image', 512)->nullable()->comment(__('db.genres.image'));

            MigrateUtils::timestamps($table, false);

            $table->foreign('parent_id')
                ->references('id')
                ->on('genres')
                ->onDelete('set null');
        });

        Schema::create('genre_closure', function (Blueprint $table) {
            $table->increments('closure_id');

            $table->unsignedBigInteger('ancestor', false, true);
            $table->unsignedBigInteger('descendant', false, true);
            $table->unsignedBigInteger('depth', false, true);

            $table->foreign('ancestor')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genre_closure');
        Schema::dropIfExists('genres');
    }
};
