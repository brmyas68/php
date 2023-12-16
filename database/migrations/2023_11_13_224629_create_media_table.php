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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string("model_name");
            $table->bigInteger("model_id")->unsigned();
            $table->foreignId('user_id')->unsigned()->references('id')->on('users');
            $table->string("file_name");
            $table->float("file_size")->default(0);
            $table->string("file_path");
            $table->string("mime_type");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
