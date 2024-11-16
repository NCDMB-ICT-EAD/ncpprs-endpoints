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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->default(0);
            $table->string('name');
            $table->string('label')->unique();
            $table->string('path')->unique()->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['top-level', 'index', 'view', 'form', 'external', 'dashboard', 'report'])->default('index');
            $table->boolean('is_menu')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
