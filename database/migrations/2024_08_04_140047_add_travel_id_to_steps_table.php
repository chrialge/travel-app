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
        Schema::table('steps', function (Blueprint $table) {
            $table->unsignedBigInteger('travel_id')->after('id')->nullable();

            $table->foreign('travel_id')->references('id')->on('travel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('steps', function (Blueprint $table) {
            $table->foreign('steps_travel_id_foreign');

            $table->dropForeign('travel_id');
        });
    }
};
