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
        Schema::create('sub_tests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_subtest_id')->nullable();
            $table->unsignedBigInteger('try_out_id');
            $table->string('name');
            $table->integer('total_question');
            $table->integer('duration');
            $table->foreign('category_subtest_id')->references('id')->on('category_subtests')->onDelete('set null');
            $table->foreign('try_out_id')->references('id')->on('try_outs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tests');
    }
};
