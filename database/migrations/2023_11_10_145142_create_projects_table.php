<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ProjectType;
use App\Enums\BoolStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("image");
            $table->string("mobile_image")->nullable();
            $table->string("video")->nullable();
            $table->string("subject");
            $table->string('slug')->nullable();
            $table->foreignId("client_id")->references("id")->on("clients");
            $table->foreignId("service_id")->references("id")->on("services");
            $table->enum("type",ProjectType::ALL);
            $table->date("started_at");
            $table->date("finished_at")->nullable();
            $table->string("location");
            $table->foreignId("province_id")->references("id")->on("provinces");
            $table->foreignId("city_id")->references("id")->on("cities");
            $table->enum("is_contractor",BoolStatus::ALL)->default(BoolStatus::yes);
            $table->foreignId("contractor_id")->unsigned()->nullable()->references("id")->on("provinces");
            $table->integer("contract_duration")->default(0);
            $table->text("summery");
            $table->text("description");
            $table->enum("show_in_slider",BoolStatus::ALL)->default(BoolStatus::no);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
