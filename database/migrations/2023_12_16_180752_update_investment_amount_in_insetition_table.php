<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInvestmentAmountInInsetitionTable extends Migration
{
    public function up()
    {
        Schema::table('insetition', function (Blueprint $table) {
            $table->bigInteger('investment_amount')->change();
        });
    }

    public function down()
    {
        Schema::table('insetition', function (Blueprint $table) {
            $table->integer('investment_amount')->change();
        });
    }
}
