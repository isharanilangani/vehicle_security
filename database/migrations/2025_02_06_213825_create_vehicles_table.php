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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id('pk_id');
            $table->string('fk_owner_model', 10); // Model type (e.g., User or Guest)
            $table->unsignedBigInteger('fk_owner_id'); // Foreign key ID
            $table->string('type', 20); // Vehicle type
            $table->string('uk_vehicle_number', 20)->unique(); // Unique vehicle number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
