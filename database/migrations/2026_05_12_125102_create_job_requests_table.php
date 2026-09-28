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
    Schema::create('job_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained('users');
        $table->foreignId('service_id')->constrained('services');
        $table->string('city');
        $table->text('description');
        $table->decimal('min_price', 10, 2); // أقل ثمن
        $table->decimal('max_price', 10, 2); // أكثر ثمن
        // اللوكاليزاسيون (GPS)
        $table->decimal('lat', 10, 8)->nullable(); 
        $table->decimal('lng', 11, 8)->nullable();
        $table->string('status')->default('open'); // open, closed
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_requests');
    }
};
