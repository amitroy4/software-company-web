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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('quote')->nullable();
            $table->text('description')->nullable();
            $table->integer('year_of_experience')->nullable();
            $table->string('image')->nullable();
            $table->string('counter_title')->nullable();
            $table->string('counter_icon')->nullable();
            $table->integer('data_count')->nullable();
            $table->string('counter_symbol')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
