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
        Schema::create('employments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->year('year');
            $table->enum('period', Periods::QUARTERS);

            $table->integer('new_foreign_permanent')->default(0);
            $table->integer('new_foreign_contract')->default(0);
            $table->integer('new_foreign_others')->default(0);
            $table->integer('new_nigerian_permanent')->default(0);
            $table->integer('new_nigerian_contract')->default(0);
            $table->integer('new_nigerian_others')->default(0);

            $table->integer('total_foreign_permanent')->default(0);
            $table->integer('total_foreign_contract')->default(0);
            $table->integer('total_foreign_others')->default(0);
            $table->integer('total_nigerian_permanent')->default(0);
            $table->integer('total_nigerian_contract')->default(0);
            $table->integer('total_nigerian_others')->default(0);

            $table->longText('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
};
