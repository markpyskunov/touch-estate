<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->json('payload');
            $table->timestamps();
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
