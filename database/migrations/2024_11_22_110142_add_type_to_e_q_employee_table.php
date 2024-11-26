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
        Schema::table('e_q_employees', function (Blueprint $table) {
            $table->enum('type', ['expatriate', 'understudy'])->default('expatriate')->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('e_q_employees', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
