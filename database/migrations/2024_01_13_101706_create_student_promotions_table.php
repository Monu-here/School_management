<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Inside your migration file
    public function up(): void
    {
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('from_class');
            $table->string('from_section');
            $table->string('to_class'); // Change to string
            $table->string('to_section');
            $table->string('from_session');
            $table->string('to_session');
            $table->string('status');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_promotions');
    }
};
