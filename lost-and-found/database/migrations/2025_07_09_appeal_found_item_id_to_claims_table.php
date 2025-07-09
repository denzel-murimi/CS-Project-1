<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            // Add found_item_id if not present
            if (!Schema::hasColumn('claims', 'found_item_id')) {
                $table->unsignedBigInteger('found_item_id')->nullable()->after('lost_item_id');
                $table->foreign('found_item_id')->references('id')->on('items')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            if (Schema::hasColumn('claims', 'found_item_id')) {
                $table->dropForeign(['found_item_id']);
                $table->dropColumn('found_item_id');
            }
        });
    }
};
