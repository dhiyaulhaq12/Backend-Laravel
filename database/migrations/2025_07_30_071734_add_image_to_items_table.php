<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('items', 'image')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('image')->nullable()->after('description'); // simpan path/nama file
            });
        }
    }

    public function down(): void
    {
        // Drop kolom hanya jika ada
        if (Schema::hasColumn('items', 'image')) {
            Schema::table('items', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
