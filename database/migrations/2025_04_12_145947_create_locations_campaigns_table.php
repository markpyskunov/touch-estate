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
        Schema::create('locations_campaigns', function (Blueprint $table) {
            $table->foreignUuid('location_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignUuid('campaign_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('active_from');
            $table->boolean('default')->default(false);

            $table->primary(['location_id', 'campaign_id']);
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
