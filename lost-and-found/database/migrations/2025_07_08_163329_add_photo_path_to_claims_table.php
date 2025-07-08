<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends \Illuminate\Database\Migrations\Migration {
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn('photo_path');
        });
    }
};


