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
        Schema::table('tasks', function (Blueprint $table) {
            // We do not have to report the table here inside the constrained() function,
            // because we used the column project_id, so the laravel knows that it is about the project table
            $table->foreignId('project_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations - ROLLBACK
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropConstrainedForeignId('project_id');
        });
    }
};
