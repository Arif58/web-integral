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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('first_major')->nullable();
            $table->unsignedBigInteger('second_major')->nullable();
            $table->unsignedBigInteger('interest')->nullable();

            $table->foreign('first_major')->references('id')->on('majors')->onDelete('set null');
            $table->foreign('second_major')->references('id')->on('majors')->onDelete('set null');
            $table->foreign('interest')->references('id')->on('clusters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign keys
            $table->dropForeign(['first_major']);
            $table->dropForeign(['second_major']);
            $table->dropForeign(['interest']);
        });
    }
};
