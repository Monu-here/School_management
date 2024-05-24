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
        Schema::table('student_promotions', function (Blueprint $table) {
            $table->unsignedInteger('from_faculity');
            $table->unsignedInteger('to_faculity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_promotions', function (Blueprint $table) {
            $table->dropColumn('from_faculity');
            $table->dropColumn('to_faculity');
        });
    }
};
