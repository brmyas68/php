<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SliderType;
use App\Enums\BoolStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string("file")->nullable();
            $table->string("mobile_file")->nullable();
            $table->enum("type",SliderType::ALL)->nullable();
            $table->enum("mobile_file_type",SliderType::ALL)->nullable();
            $table->string("title")->nullable();
            $table->string("link")->nullable();
            $table->integer("order")->unsigned()->default(1);
            $table->foreignId("project_id")->unsigned()->nullable()->references("id")->on("projects");
            $table->enum("is_active",BoolStatus::ALL)->default(BoolStatus::yes);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
