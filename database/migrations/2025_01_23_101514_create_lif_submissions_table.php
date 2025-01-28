<?php

use App\Pack\Helpers\Periods;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lif_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lif_service_id')->constrained()->cascadeOnDelete();
            $table->year('year');
            $table->enum('period', Periods::HALVES);
            $table->enum('time_frame', Periods::TIMEFRAMES);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lif_submissions');
    }
};
