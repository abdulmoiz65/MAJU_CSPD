<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('upcoming_programs', function (Blueprint $table) {
            $table->string('trainer_image')->nullable()->after('trainer_profile');
            $table->string('enroll_link')->default('https://docs.google.com/forms/d/e/1FAIpQLSdWrXKQl_OMKYznN8sUVK7SYjP6VTQ-_AHhhI2eKKUUxKWWVw/viewform')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upcoming_programs', function (Blueprint $table) {
            //
        });
    }
};
