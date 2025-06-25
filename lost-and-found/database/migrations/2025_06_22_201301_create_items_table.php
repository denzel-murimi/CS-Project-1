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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->string('location');
            $table->datetime('date_lost_found');
            $table->enum('type', ['lost', 'found']);
            $table->enum('status', ['active', 'returned', 'claimed'])->default('active');
            $table->text('contact_info')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('reward_offered')->default(false);
            $table->decimal('reward_amount', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['type', 'status']);
            $table->index(['category']);
            $table->index(['created_at']);
            $table->index(['user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
