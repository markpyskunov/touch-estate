<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitors_subscribed_to_locations', function (Blueprint $table) {
            $table->foreignUuid('location_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('visitor_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['location_id', 'visitor_id']);
            $table->index(['location_id']);
        });
    }

    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
