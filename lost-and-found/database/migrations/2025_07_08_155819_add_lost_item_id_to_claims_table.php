<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->unsignedBigInteger('lost_item_id')->nullable()->after('item_id');

            $table->foreign('lost_item_id')
                ->references('id')
                ->on('items')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropForeign(['lost_item_id']);
            $table->dropColumn('lost_item_id');
        });
    }
};
