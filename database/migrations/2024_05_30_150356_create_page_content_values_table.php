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
        Schema::create('page_content_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_content_id')->constrained('page_contents')->onDelete('cascade');
            $table->text('value');
            $table->enum('type', ['text', 'link', 'filter'])->default('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_content_values');
    }
};
