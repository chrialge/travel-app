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
        Schema::table('notes', function (Blueprint $table) {
            $table->unsignedBigInteger('step_id')->after('id')->nullable();
            $table->foreign('step_id')->references('id')->on('steps');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('notes_step_id_foreign');

            $table->dropForeign('step_id');
        });
    }
};
