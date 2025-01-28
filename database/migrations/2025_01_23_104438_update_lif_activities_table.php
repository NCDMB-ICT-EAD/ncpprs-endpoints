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
        Schema::dropIfExists('lif_activities');
        Schema::create('lif_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lif_submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lif_service_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lif_institution_id')->constrained()->cascadeOnDelete();
            $table->foreignId('broker_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_activities');
    }
};
