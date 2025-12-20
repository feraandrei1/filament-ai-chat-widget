<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_conversations', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->longText('messages');

            $table->string('model')->default('gpt-4o-mini');
            $table->decimal('temperature', 3, 2)->default(0.5);
            $table->integer('max_tokens')->default(500);

            $table->integer('tokens_used')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_conversations');
    }
};
