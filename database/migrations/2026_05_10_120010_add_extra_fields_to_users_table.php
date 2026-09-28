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
    Schema::table('users', function (Blueprint $table) {
        // إذا ماكانتش 'role' فـ الميغراسيون الأصلية ديال Users، زيدها هنا:
        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['client', 'artisan'])->default('client');
        }
        $table->string('city')->nullable();
        $table->foreignId('service_id')->nullable()->constrained('services');
    });

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
