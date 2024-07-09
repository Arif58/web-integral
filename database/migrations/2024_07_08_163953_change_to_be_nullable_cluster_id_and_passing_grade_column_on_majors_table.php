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
        Schema::table('majors', function (Blueprint $table) {
            $table->unsignedBigInteger('cluster_id')->nullable()->change();
            $table->double('passing_grade')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->unsignedBigInteger('cluster_id')->nullable(false)->change();
            $table->double('passing_grade')->nullable(false)->change();
        });
    }
};
