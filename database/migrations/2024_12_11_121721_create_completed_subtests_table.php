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
        Schema::create('completed_subtests', function (Blueprint $table) {
            $table->id();
            $table->uuid('participant_id'); 
            $table->unsignedBigInteger('sub_test_id');
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->double('score')->nullable();
            $table->string('status')->default('in-progress');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->foreign('sub_test_id')->references('id')->on('sub_tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_subtests');
    }
};
