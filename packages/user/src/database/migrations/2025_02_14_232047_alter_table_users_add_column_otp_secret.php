<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::whenTableDoesntHaveColumn(
            table: "users",
            column: "otp_secret",
            callback: fn(Blueprint $table) => $table
                ->string("otp_secret")
                ->nullable()
                ->after("status")
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::whenTableHasColumn(
            table: "users",
            column: "otp_secret",
            callback: fn(Blueprint $table) => $table->dropColumn("otp_secret")
        );
    }
};
