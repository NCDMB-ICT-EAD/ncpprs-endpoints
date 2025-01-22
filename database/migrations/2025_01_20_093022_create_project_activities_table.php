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
        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_submission_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_scope_id')->constrained()->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->decimal('total_value_spent', 15, 2);
            $table->decimal('nc_value_spent', 15, 2)->default(0);
            $table->integer('no_of_nigerians')->default(0);
            $table->integer('no_of_expatriates')->default(0);
            $table->decimal('nigerians_man_hours', 10, 2)->default(0);
            $table->decimal('expatriates_man_hours', 10, 2)->default(0);
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
