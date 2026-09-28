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
    Schema::create('bids', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_request_id')->constrained('job_requests')->onDelete('cascade');
        $table->foreignId('artisan_id')->constrained('users');
        $table->decimal('price', 10, 2); // الثمن لي اقترح الحريفي
        $table->text('message')->nullable();
        $table->string('status')->default('pending'); // pending, accepted, rejected
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
