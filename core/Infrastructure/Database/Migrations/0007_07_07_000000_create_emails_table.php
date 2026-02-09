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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string("slug")->unique();
            $table->morphs("emailable");
            $table->string("email");
            $table->timestamp("email_verified_at")->nullable();
            $table->boolean("primary")->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(["emailable_type", "emailable_id", "email"], "model_email_unique");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
