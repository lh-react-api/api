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
        Schema::create('inquiry_types', function (Blueprint $table) {
            $table->comment('お問い合わせ種別');

            $table->id()->comment(__('db.inquiry_types.id'));
            $table->string('text', 128)->comment(__('db.inquiry_types.text'));

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
        Schema::dropIfExists('inquery_types');
    }
};
