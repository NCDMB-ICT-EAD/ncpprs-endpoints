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
        Schema::create('capacity_building_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('capacity_building_id');
            $table->foreign('capacity_building_id')->references('id')->on('capacity_buildings')->onDelete('cascade');
            $table->bigInteger('man_hrs')->default(0);
            $table->decimal('nc_spend', 30, 2)->default(0);
            $table->decimal('total_spend', 30, 2)->default(0);
            $table->longText('description')->nullable();
            $table->year('year')->nullable();
            $table->string('period')->nullable();
            $table->longText('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacity_building_activities');
    }
};
