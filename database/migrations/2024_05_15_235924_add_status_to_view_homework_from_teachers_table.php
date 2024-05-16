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
        Schema::table('view_homework_from_teachers', function (Blueprint $table) {
            $table->string('status')->default('Not Submitted');
            $table->unsignedBigInteger('student_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('view_homework_from_teachers', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('student_id');

        });
    }
};
