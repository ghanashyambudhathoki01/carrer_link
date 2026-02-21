<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_seeker_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('headline')->nullable(); // e.g. "Senior Laravel Developer"
            $table->text('bio')->nullable();
            $table->string('resume_path')->nullable();
            $table->json('skills')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('current_location')->nullable();
            $table->string('preferred_location')->nullable();
            $table->string('expected_salary')->nullable();
            $table->enum('availability', ['immediately', 'within_month', 'negotiable'])->default('negotiable');
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('portfolio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_seeker_profiles');
    }
};
