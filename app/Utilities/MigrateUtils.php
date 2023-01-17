<?php

namespace App\Utilities;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrateUtils extends Migration
{
    /**
     * Run the migrations.
     *
     * @param Blueprint $table
     * @param $isForeign
     * @return Blueprint
     */
    static public function timestamps(Blueprint $table, $isForeign=true)
    {
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();

        if ($isForeign) {
            $table->foreign('created_by')->onDelete('cascade')->onDelete('cascade')->references('id')->on('users');
            $table->foreign('updated_by')->onDelete('cascade')->onDelete('cascade')->references('id')->on('users');
        }

        return  $table;;
    }

}
