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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->unsignedBigInteger('cluster_id');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
            $table->foreign('cluster_id')->references('id')->on('clusters')->onDelete('cascade');
            $table->string('name');
            $table->double('passing_grade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
