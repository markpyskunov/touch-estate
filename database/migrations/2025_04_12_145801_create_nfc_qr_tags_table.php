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
        Schema::create('nfc_qr_tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('location_id')->nullable()->constrained()->restrictOnDelete()->restrictOnUpdate();
            $table->string('name', 255);
            $table->string('code', 4);
            $table->unsignedMediumInteger('index');
            $table->timestamps();
            $table->softDeletes();
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
