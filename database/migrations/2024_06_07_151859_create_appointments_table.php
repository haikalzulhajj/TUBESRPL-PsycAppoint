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
        Schema::create('appointments', function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->ulid('user_id');
            $table->ulid('specialist_id');
            $table->timestamp('time')->default(null);
            $table->text('message')->nullable();
            $table->string('payment');
            $table->string('status')->default('requested');
            $table->text('review')->nullable();
            $table->text('feedback')->nullable();
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
