<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('location_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUuid('campaign_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignUuid('visitor_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('type', 32);
            $table->string('event', 128);
            $table->json('metadata');
            $table->timestamps();

            $table->index(['type', 'event', 'created_at']);
        });

        Schema::create('visitor_activity_aggregations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('location_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->enum('aggregation_type', [
                'daily',
                'weekly',
                'monthly',
                'annually',
                'all_time',
            ]);
            $table->unsignedMediumInteger('year')->nullable();
            $table->unsignedTinyInteger('month')->nullable();
            $table->unsignedTinyInteger('week')->nullable();
            $table->unsignedTinyInteger('day')->nullable();
            $table->string('event', 128);
            $table->string('value');
            $table->timestamps();

            $table->index(['aggregation_type', 'year', 'month', 'week', 'day']);
        });

        Schema::table('visitor_activities', function (Blueprint $table) {
            $table->foreignUuid('visitor_activity_aggregation_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });

        Schema::table('visitor_activity_aggregations', function (Blueprint $table) {
            $table->foreignUuid('visitor_activity_aggregation_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        throw new Exception('Down method is not allowed for this project');
    }
};
