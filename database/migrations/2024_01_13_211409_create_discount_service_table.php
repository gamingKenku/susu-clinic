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
        Schema::create('discounts_services_junc', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('discount_id')->constrained('discounts')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_service');
    }
};
