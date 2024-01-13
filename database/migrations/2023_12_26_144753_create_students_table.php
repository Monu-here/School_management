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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('idno');
            $table->text('name');
            $table->text('gender');
            $table->date('dob');
            $table->integer('roll');
            $table->text('email')->nullable();
            $table->text('number')->nullable();
            $table->text('image')->nullable();
            $table->text('section');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
