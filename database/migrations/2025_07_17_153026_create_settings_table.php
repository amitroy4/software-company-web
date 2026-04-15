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
      Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('company_name')->nullable();
    $table->string('copyright_text')->nullable();
    $table->text('description')->nullable();
    $table->string('registration_number')->nullable();
    $table->string('trade_license')->nullable();
    $table->string('vat_number')->nullable();
    $table->string('contact_number')->nullable();
    $table->string('whatsapp_number')->nullable();
    $table->string('hotline_number')->nullable();
    $table->string('email')->nullable();
    $table->string('alt_email')->nullable();
    $table->string('website')->nullable();
    $table->string('linkedin')->nullable();
    $table->string('facebook')->nullable();
    $table->string('landing_page')->nullable();
    $table->text('google_map')->nullable();
    $table->text('address')->nullable();
    $table->string('logo_dark')->nullable();
    $table->string('logo_light')->nullable();
    $table->string('favicon')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
