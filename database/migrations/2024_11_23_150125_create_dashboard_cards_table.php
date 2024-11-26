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
        Schema::create('dashboard_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->string('title');
            $table->string('table_name');
            $table->enum('flag', ['admin', 'department', 'user', 'contractor'])->default('user');
            $table->enum('period', ['all-time', 'current', 'custom'])->default('custom');
            $table->text('filters')->nullable();
            $table->enum('order_by', ['sort', 'count'])->default('sort');
            $table->enum('data_sort', ['asc', 'desc'])->default('desc');
            $table->text('tagline')->nullable();
            $table->string('path')->nullable();
            $table->string('type')->nullable();
            $table->string('method_name')->nullable();
            $table->boolean('is_disabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_cards');
    }
};
