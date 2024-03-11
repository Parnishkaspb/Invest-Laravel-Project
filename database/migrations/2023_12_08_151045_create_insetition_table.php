<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insetition', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity_time');
            $table->float('investment_amount');
            $table->boolean('is_agreed');
            $table->time('end_time');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insetition');
    }
};
