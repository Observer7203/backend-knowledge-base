<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->string('id')->primary(); // e.g. 'kb1', 'kb2'
            $table->string('title');
            $table->string('file');
            $table->integer('total_topics')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('module_id');
            $table->string('title');
            $table->string('status')->default('not_started'); // not_started, in_progress, done
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('module_id')->references('id')->on('modules')->cascadeOnDelete();
        });

        Schema::create('study_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('module_id')->nullable();
            $table->integer('duration_minutes')->default(0);
            $table->string('notes')->nullable();
            $table->date('studied_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_sessions');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('modules');
    }
};
