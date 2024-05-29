<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('image');
            $table->string('status')->default('draft')->after('published_at');
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->string('slug')->unique()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('published_at');
            $table->dropColumn('status');
            $table->dropColumn('slug');
            $table->dropForeign(['user_id']);
            $table->foreignId('user_id')->constrained();
        });
    }
};
