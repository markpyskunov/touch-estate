<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('address_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('company_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->uuid('campaign_id')->nullable();
            $table->foreignUuid('realtor_id')->nullable()->constrained('users')->restrictOnDelete()->cascadeOnUpdate();
            $table->uuid('nfc_qr_tag_id')->nullable();
            $table->unsignedMediumInteger('area_sqft')->nullable();
            $table->text('description')->nullable();
            $table->string('name', 255);
            $table->string('mls', 32)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
