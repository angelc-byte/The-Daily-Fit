<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The avatar column already exists in the TFA6 staff-fields migration.
        // TFA7 creates directory accounts, not login credentials.
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('password')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Preserve directory records with null credentials when rolling back.
        // The original create_users migration still removes the entire table.
    }
};
