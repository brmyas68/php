<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BoolStatus;
use App\Enums\Sex;
use App\Enums\ResumeStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string("resume")->nullable();
            $table->string("name");
            $table->string("last_name");
            $table->date("birthday")->nullable();
            $table->enum("sex",Sex::ALL);
            $table->string("mobile");
            $table->string("email")->nullable();
            $table->string("last_job_title")->nullable();
            $table->string("organization_name")->nullable();
            $table->string("activity_in_organization")->nullable();
            $table->date("start_date")->nullable();
            $table->date("finish_date")->nullable();
            $table->enum("still_work",BoolStatus::ALL)->default(BoolStatus::no)->nullable();
            $table->text("description")->nullable();
            $table->enum("is_seen",BoolStatus::ALL)->default(BoolStatus::no);
            $table->enum("status",ResumeStatus::ALL)->default(ResumeStatus::undefined);
            $table->dateTime("confirmed_at")->nullable();
            $table->dateTime("rejected_at")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
