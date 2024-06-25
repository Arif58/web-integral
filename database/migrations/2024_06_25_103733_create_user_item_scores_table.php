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
        Schema::create('user_item_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->uuid('participant_id');
            $table->integer('score');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_item_scores');
    }
};
