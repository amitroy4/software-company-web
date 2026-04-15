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
        Schema::create('service_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            // $table->string('title')->nullable();
            // $table->text('description')->nullable();
            // $table->string('image')->nullable();
            $table->string('keypoint_title')->nullable();
            $table->string('keypoint_details')->nullable();
            // $table->string('keypoint_title_2')->nullable();
            // $table->string('keypoint_details_2')->nullable();
            // $table->string('keypoint_title_3')->nullable();
            // $table->string('keypoint_details_3')->nullable();
            // $table->string('keypoint_title_4')->nullable();
            // $table->string('keypoint_details_4')->nullable();
            // $table->string('keypoint_title_5')->nullable();
            // $table->string('keypoint_details_5')->nullable();
            // $table->string('keypoint_title_6')->nullable();
            // $table->string('keypoint_details_6')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_needs');
    }
};
