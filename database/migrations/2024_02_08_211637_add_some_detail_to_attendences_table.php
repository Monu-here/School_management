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
        Schema::table('attendences', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id')->nullable();
            $table->json('attendance_type')->nullable();
            $table->string('notes')->nullable();
            $table->date('attendance_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendences', function (Blueprint $table) {
            $table->dropColumn('student_id');
            $table->dropColumn('attendance_type');
            $table->dropColumn('notes');
            $table->dropColumn('attendance_date');
        });
    }
};
