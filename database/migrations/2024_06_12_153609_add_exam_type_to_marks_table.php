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
        Schema::table('marks', function (Blueprint $table) {
            $table->string('exam_type')->nullable();
            $table->string('resit')->nullable();
            $table->string('repeat')->nullable();
            $table->string('point')->nullable();
            $table->string('hp')->nullable();
            $table->string('hc')->nullable();
            $table->string('gpa')->nullable();
            $table->string('cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropColumn('exam_type');
            $table->dropColumn('resit');
            $table->dropColumn('repeat');



            $table->dropColumn('point')->nullable();
            $table->dropColumn('hp')->nullable();
            $table->dropColumn('hc')->nullable();
            $table->dropColumn('gpa')->nullable();
            $table->dropColumn('cgpa')->nullable();
        });
    }
};
