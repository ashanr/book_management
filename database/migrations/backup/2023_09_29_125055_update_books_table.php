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
        Schema::table('books', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('author')->nullable();
            $table->string('isbn')->nullable();
            $table->string('status')->default('available'); // default value set to 'available'
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['title', 'author', 'isbn', 'status']);
        });

    }
};
