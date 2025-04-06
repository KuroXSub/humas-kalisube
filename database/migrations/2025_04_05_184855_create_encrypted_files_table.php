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
        Schema::create('encrypted_files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('original_name');
            $table->string('encrypted_path');
            $table->string('file_type');
            $table->string('key_hash');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('encrypted_files');
    }
};
