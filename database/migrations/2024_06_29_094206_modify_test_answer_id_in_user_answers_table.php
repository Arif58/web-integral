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
        Schema::table('user_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('test_answer_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropForeign('user_answers_test_answer_id_foreign');
            $table->dropColumn('test_answer_id');
        });
        Schema::table('user_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('test_answer_id');
            $table->foreign('test_answer_id')->references('id')->on('test_answers')->onDelete('cascade');
        });
    }
};
