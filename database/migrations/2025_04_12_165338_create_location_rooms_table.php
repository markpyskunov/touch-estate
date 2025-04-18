<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_rooms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('location_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type', 32);
            $table->tinyInteger('level');
            $table->string('name');
            $table->unsignedInteger('area_sqft');
            $table->string('width_ft', 8);
            $table->string('length_ft', 8);
            $table->string('width_meters', 8);
            $table->string('length_meters', 8);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
