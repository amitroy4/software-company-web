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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_name')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('service_details')->nullable();
            $table->string('counter_title')->nullable();
            $table->string('counter_icon')->nullable();
            $table->integer('data_count')->nullable();
            $table->string('counter_symbol')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('contact_url')->nullable();
            $table->string('button_text')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
