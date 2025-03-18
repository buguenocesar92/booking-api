<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSpecialtyColumnFromProfessionalsTable extends Migration
{
    public function up()
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->dropColumn('specialty');
        });
    }

    public function down()
    {
        Schema::table('professionals', function (Blueprint $table) {
            $table->string('specialty')->nullable(); // O sin nullable, según tu necesidad.
        });
    }
}
