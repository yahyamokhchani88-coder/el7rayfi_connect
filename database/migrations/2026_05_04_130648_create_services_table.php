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
            Schema::create('services', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Smiya: سباكة، كهرباء...
                $table->text('description'); // Wasf dial l-khidma
                $table->string('icon'); // Smiya dial l-icon (مثلا: faucet)
                $table->string('slug')->unique(); // Bach l-url iji n9i (مثلا: /services/plomberie)
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
