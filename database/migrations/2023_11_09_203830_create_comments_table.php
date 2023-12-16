<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BoolStatus;
use App\Enums\CommentType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text("comment");
            $table->integer("parent_id")->unsigned()->nullable()->default(0);
            $table->string("name");
            $table->string("email");
            $table->enum("type",CommentType::ALL);
            $table->integer("type_id")->unsigned();
            $table->enum("is_show",BoolStatus::ALL)->default(BoolStatus::no);
            $table->dateTime("show_at")->nullable();
            $table->enum("is_seen",BoolStatus::ALL)->default(BoolStatus::no);
            $table->enum("admin_reply",BoolStatus::ALL)->default(BoolStatus::no);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
