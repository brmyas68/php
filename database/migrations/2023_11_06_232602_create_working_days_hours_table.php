<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\DaysHoursStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('working_days_hours', function (Blueprint $table) {
            $table->id();
            $table->string("day");
            $table->enum("status",DaysHoursStatus::ALL)->default(DaysHoursStatus::open);
            $table->string("start_work")->nullable();
            $table->string("end_work")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_days_hours');
    }
};
