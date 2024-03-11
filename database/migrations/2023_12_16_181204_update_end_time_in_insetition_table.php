<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEndTimeInInsetitionTable extends Migration
{
    public function up()
    {
        Schema::table('insetition', function (Blueprint $table) {
            $table->date('end_time')->change();
        });
    }

    public function down()
    {
        Schema::table('insetition', function (Blueprint $table) {
            $table->time('end_time')->change();
        });
    }
}
