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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string("slug")->unique();
            $table->morphs("phoneable");
            $table->string("country_code");
            $table->string("number");
            $table->boolean("primary")->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(["phoneable_type", "phoneable_id", "number"], "model_phone_unique");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
