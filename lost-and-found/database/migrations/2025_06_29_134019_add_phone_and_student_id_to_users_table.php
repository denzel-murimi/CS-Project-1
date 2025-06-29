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
        Schema::table('users', function (Blueprint $table) {
            // Add the 'phone' column
            // It's good practice to make it nullable if it's not strictly required,
            // or provide a default value.
            $table->string('phone')->nullable()->after('password'); // Adds after 'password' column

            // Add the 'student_id' column
            // Make it nullable or unique depending on your requirements.
            $table->string('student_id')->nullable()->unique()->after('phone'); // Adds after 'phone' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the 'phone' and 'student_id' columns if the migration is rolled back
            $table->dropColumn(['phone', 'student_id']);
        });
    }
};
