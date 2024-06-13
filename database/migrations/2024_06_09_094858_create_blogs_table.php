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
        Schema::create('blogs', function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->string('slug');
            $table->string('heading');
            $table->string('title');
            $table->text('preview');
            $table->text('content');
            $table->ulid('creator');
            $table->string('status')->default('pending');
            $table->boolean('points')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
