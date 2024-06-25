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
            $table->dropForeign('user_answers_user_id_foreign');
        });

        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('user_answers', function (Blueprint $table) {
            $table->uuid('participant_id')->after('id');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropForeign('user_answers_participant_id_foreign');
        });

        Schema::table('user_answers', function (Blueprint $table) {
            $table->dropColumn('participant_id');
        });

        Schema::table('user_answers', function (Blueprint $table) {
            $table->uuid('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
