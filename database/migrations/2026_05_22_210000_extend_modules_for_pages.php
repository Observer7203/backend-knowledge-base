<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('id');
            $table->text('description')->nullable()->after('title');
            $table->string('badge', 64)->nullable()->after('description');
            $table->string('badge_class', 64)->nullable()->after('badge');
            $table->string('icon', 64)->nullable()->after('badge_class');
            $table->string('icon_class', 64)->nullable()->after('icon');
            $table->string('group_name', 64)->nullable()->after('icon_class');
            $table->string('layout', 16)->default('sidebar')->after('group_name');
            $table->boolean('is_published')->default(true)->after('layout');
        });
    }

    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'description', 'badge', 'badge_class',
                'icon', 'icon_class', 'group_name', 'layout', 'is_published',
            ]);
        });
    }
};
