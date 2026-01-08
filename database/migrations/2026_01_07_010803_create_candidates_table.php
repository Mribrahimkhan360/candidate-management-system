<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('experience_years');
            $table->json('previous_experience')->nullable();
            $table->integer('age');
            $table->enum('status', ['pending', 'first_interview_scheduled', 'first_interview_completed', 'passed_first', 'rejected_first', 'second_interview_scheduled', 'second_interview_completed', 'hired', 'rejected_final'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};