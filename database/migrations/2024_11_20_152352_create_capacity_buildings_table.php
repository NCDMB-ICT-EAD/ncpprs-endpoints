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
        Schema::create('capacity_buildings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->unsignedBigInteger('contractor_id');
            $table->foreign('contractor_id')->references('id')->on('companies')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->bigInteger('planned_man_hrs')->default(0);
            $table->decimal('nc_spend', 30, 2)->default(0);
            $table->decimal('total_spend', 30, 2)->default(0);
            $table->string('certificate')->nullable();
            $table->text('remark')->nullable();
            $table->enum('flag', ['hcd', 'cdi'])->default('hcd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacity_buildings');
    }
};
