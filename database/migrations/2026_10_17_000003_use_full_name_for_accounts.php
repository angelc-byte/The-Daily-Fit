<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['customers', 'users'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->renameColumn('name', 'full_name');
            });
        }
    }

    public function down(): void
    {
        foreach (['customers', 'users'] as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->renameColumn('full_name', 'name');
            });
        }
    }
};
