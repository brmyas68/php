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
        Schema::create('weblogs', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->string("subject");
            $table->string('slug')->nullable();
            $table->foreignId("user_id")->references("id")->on("users");
            $table->foreignId("category_id")->unsigned()->references("id")->on("categories");
            $table->foreignId("service_id")->unsigned()->nullable()->references("id")->on("services");
            $table->integer("views")->unsigned()->default(0);
            $table->text("description");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weblogs');
    }
};
