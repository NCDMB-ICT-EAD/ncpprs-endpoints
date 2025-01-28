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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('training_category_id')->constrained()->cascadeOnDelete();
            $table->year('year');
            $table->enum('period', Periods::QUARTERS);
            $table->integer('no_of_trainees')->default(0);
            $table->decimal('expenditure', 15, 2)->default(0);
            $table->longText('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
