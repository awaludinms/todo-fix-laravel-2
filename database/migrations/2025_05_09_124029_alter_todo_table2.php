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
        //
        DB::statement("ALTER TABLE todos MODIFY COLUMN is_deleted INT DEFAULT 1");
        DB::statement("UPDATE todos SET is_deleted=0");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
