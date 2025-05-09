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
        Schema::table('todos', function(Blueprint $table){
            $table->boolean('is_deleted')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->datetime('deleted_at')->nullable()->default(null);
            $table->integer('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
