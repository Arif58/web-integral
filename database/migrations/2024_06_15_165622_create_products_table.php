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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('tryout_id');
            $table->bigInteger('price');
            $table->integer('ie_gems')->nullable();
            $table->json('features');
            $table->text('answer_explanation_file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreign('tryout_id')->references('id')->on('try_outs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
