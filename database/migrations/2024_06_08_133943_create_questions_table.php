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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_test_id');
            $table->string('type');
            $table->text('question_text');
            $table->double('difficulty_parameter', 8, 3)->nullable();
            $table->text('question_image')->nullable();
            $table->timestamps();
            $table->foreign('sub_test_id')->references('id')->on('sub_tests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
