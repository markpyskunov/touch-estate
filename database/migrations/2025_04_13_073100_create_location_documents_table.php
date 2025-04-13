<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('location_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('location_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('url');
            $table->string('size');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
