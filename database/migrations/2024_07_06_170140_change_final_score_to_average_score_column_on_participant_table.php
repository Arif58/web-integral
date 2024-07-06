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
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('final_score');
        });
        Schema::table('participants', function (Blueprint $table) {
            $table->double('average_score')->nullable()->after('end_test');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn('average_score');
        });
        Schema::table('participants', function (Blueprint $table) {
            $table->integer('final_score')->nullable()->after('end_test');
        });
    }
};
