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
        Schema::create('tag_weblog', function (Blueprint $table) {
            $table->id();
            $table->index("tag_id");
            $table->foreignId("tag_id")->references("id")->on("tags");
            $table->index("weblog_id");
            $table->foreignId("weblog_id")->references("id")->on("weblogs");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_weblog');
    }
};
