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
    Schema::create('upcoming_programs', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('overview')->nullable();
        $table->text('course_outline')->nullable();
        $table->text('learning_outcomes')->nullable();
        $table->text('methodology')->nullable();
        $table->text('activities')->nullable();
        $table->text('trainer_profile')->nullable();
        $table->text('who_should_attend')->nullable();
        $table->text('publications')->nullable();
        
        // Date & Time Information
        $table->date('start_date')->nullable();
        $table->date('end_date')->nullable();
        $table->string('duration')->nullable(); // e.g., "1 Day", "2 Days"
        $table->string('total_hours')->nullable(); // e.g., "8 Hours"
        $table->string('timing')->nullable(); // e.g., "9:00 am to 5:00 pm"
        
        // Fees Information
        $table->decimal('fees', 10, 2)->nullable();
        $table->string('currency')->default('PKR');
        $table->text('discount_info')->nullable();
        
        // Status
        $table->enum('status', ['active', 'inactive'])->default('active');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcoming_programs');
    }
};
