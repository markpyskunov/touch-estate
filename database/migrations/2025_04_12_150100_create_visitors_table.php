<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('location_id')->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->uuid('vid');
            $table->json('collected_data');
            $table->json('visits');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['location_id', 'vid', 'created_at']);
            $table->unique(['location_id', 'vid']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
