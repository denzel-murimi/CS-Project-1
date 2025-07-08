<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('claims', function (Blueprint $table) {
        $table->timestamp('returned_at')->nullable();
    });
}

public function down(): void
{
    Schema::table('claims', function (Blueprint $table) {
        $table->dropColumn('returned_at');
    });
}

};
