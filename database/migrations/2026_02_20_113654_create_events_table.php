<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // organizer
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('location');
            $table->dateTime('event_date');
            $table->dateTime('event_end_date')->nullable();
            $table->string('organizer_name');
            $table->string('organizer_email')->nullable();
            $table->string('organizer_phone')->nullable();
            $table->string('registration_link')->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->integer('max_attendees')->nullable();
            $table->enum('type', ['job_fair', 'workshop', 'seminar', 'networking', 'webinar', 'other'])->default('other');
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');
            $table->boolean('is_approved')->default(false);
            $table->integer('views')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
