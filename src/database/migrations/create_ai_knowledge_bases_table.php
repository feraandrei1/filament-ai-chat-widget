<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_knowledge_bases', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->longText('content');

            $table->boolean('active');
            $table->integer('order_column')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_knowledge_bases');
    }
};
