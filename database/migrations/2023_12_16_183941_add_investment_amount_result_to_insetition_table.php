<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestmentAmountResultToInsetitionTable extends Migration
{
    public function up()
    {
        Schema::table('insetition', function (Blueprint $table) {
            $table->bigInteger('investment_amount_result');
        });
    }

    public function down()
    {
        Schema::table('insetition', function (Blueprint $table) {
            $table->dropColumn('investment_amount_result');
        });
    }
}
