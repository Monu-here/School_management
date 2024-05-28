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
        Schema::table('students', function (Blueprint $table) {
            // Add columns if they do not already exist
            if (!Schema::hasColumn('students', 'f_name')) {
                $table->string('f_name', 255)->nullable();
            }
            if (!Schema::hasColumn('students', 'f_occ')) {
                $table->string('f_occ', 255)->nullable();
            }
            if (!Schema::hasColumn('students', 'f_no')) {
                $table->text('f_no')->nullable();
            }
            if (!Schema::hasColumn('students', 'm_name')) {
                $table->string('m_name', 255)->nullable();
            }
            if (!Schema::hasColumn('students', 'm_occ')) {
                $table->string('m_occ', 255)->nullable();
            }
            if (!Schema::hasColumn('students', 'm_no')) {
                $table->text('m_no')->nullable();
            }
            if (!Schema::hasColumn('students', 'f_image')) {
                $table->text('f_image')->nullable();
            }
            if (!Schema::hasColumn('students', 'm_image')) {
                $table->text('m_image')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Drop columns if they exist
            if (Schema::hasColumn('students', 'f_name')) {
                $table->dropColumn('f_name');
            }
            if (Schema::hasColumn('students', 'f_occ')) {
                $table->dropColumn('f_occ');
            }
            if (Schema::hasColumn('students', 'f_no')) {
                $table->dropColumn('f_no');
            }
            if (Schema::hasColumn('students', 'm_name')) {
                $table->dropColumn('m_name');
            }
            if (Schema::hasColumn('students', 'm_occ')) {
                $table->dropColumn('m_occ');
            }
            if (Schema::hasColumn('students', 'm_no')) {
                $table->dropColumn('m_no');
            }
            if (Schema::hasColumn('students', 'f_image')) {
                $table->dropColumn('f_image');
            }
            if (Schema::hasColumn('students', 'm_image')) {
                $table->dropColumn('m_image');
            }
        });
    }
};
