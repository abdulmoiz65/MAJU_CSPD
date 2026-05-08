<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('summer_schools', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview')->nullable();
            $table->text('course_outline')->nullable();
            $table->text('learning_outcomes')->nullable();
            $table->text('trainer_profile')->nullable();
            $table->string('trainer_image')->nullable();
            $table->string('enroll_link')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('total_hours')->nullable();
            $table->string('timing')->nullable();
            $table->decimal('fees', 10, 2)->nullable();
            $table->string('currency')->default('PKR');
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Timeline fields
            $table->date('registration_date')->nullable();
            $table->date('online_form_availability_date')->nullable();
            $table->date('form_submission_deadline')->nullable();
            $table->date('enrollment_offers_date')->nullable();
            $table->date('fee_document_submission_date')->nullable();
            $table->date('orientation_ceremony_date')->nullable();
            $table->date('class_commencement_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('summer_schools');
    }
};
