<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('staff_code', 20)->unique()->after('id');
            $table->string('username', 50)->unique()->after('name');
            $table->string('role', 50)->default('Sales Associate')->after('email');
            $table->string('status', 20)->default('Active')->after('role');
            $table->string('avatar')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['staff_code']);
            $table->dropUnique(['username']);
            $table->dropColumn(['staff_code', 'username', 'role', 'status', 'avatar']);
        });
    }
};
