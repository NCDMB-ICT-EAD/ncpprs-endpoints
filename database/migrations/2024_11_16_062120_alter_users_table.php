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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('identifier')->unique()->nullable()->after('id');
            $table->string('firstname')->after('identifier');
            $table->string('middlename')->nullable()->after('firstname');
            $table->string('surname')->after('middlename');
            $table->bigInteger('department_id')->unsigned()->after('surname');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->bigInteger('role_id')->unsigned()->after('department_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->enum('type', ['staff', 'third-party', 'support', 'admin'])->default('staff')->after('password');
            $table->boolean('is_admin')->default(false)->after('type');
            $table->boolean('blocked')->default(false)->after('is_admin');
            $table->boolean('change_password')->default(false)->after('blocked');
            $table->boolean('is_logged_in')->default(false)->after('change_password');
            $table->string('avatar')->nullable()->after('is_logged_in');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn('identifier');
            $table->dropColumn('firstname');
            $table->dropColumn('middlename');
            $table->dropColumn('surname');
            $table->dropConstrainedForeignId('department_id');
            $table->dropConstrainedForeignId('role_id');
            $table->dropColumn('type');
            $table->dropColumn('is_admin');
            $table->dropColumn('blocked');
            $table->dropColumn('change_password');
            $table->dropColumn('is_logged_in');
            $table->dropColumn('avatar');
        });
    }
};
