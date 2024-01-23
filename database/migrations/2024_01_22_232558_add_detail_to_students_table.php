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
            $table->string('f_name', 255)->nullable();
            $table->string('f_occ', 255)->nullable();
            $table->text('f_no')->nullable();
            $table->string('m_name', 255)->nullable();
            $table->string('m_occ', 255)->nullable();
            $table->text('m_no')->nullable();
            $table->text('f_image')->nullable();
            $table->text('m_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('f_name');
            $table->dropColumn('f_occ');
            $table->dropColumn('f_no');
            $table->dropColumn('m_name');
            $table->dropColumn('m_occ');
            $table->dropColumn('m_no');
            $table->dropColumn('f_image');
            $table->dropColumn('m_image');
        });
    }
};
