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
        Schema::table('upcoming_programs', function (Blueprint $table) {
            $table->string('brochure')->nullable()->after('discount_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('upcoming_programs', function (Blueprint $table) {
            $table->dropColumn('brochure');
        });
    }
};
