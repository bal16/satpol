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
        Schema::table('galleries', function (Blueprint $table) {
            // Tambahkan kolom category_id setelah kolom tertentu (misalnya 'title' atau 'description')
            // Sesuaikan 'after_column_name' dengan nama kolom yang ada di tabel galleries Anda
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null')->after('description');

            $table->dropColumn('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category');
        });
    }
};
