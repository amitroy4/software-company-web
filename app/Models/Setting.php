<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // If your table name is not plural ('settings'), you can skip this
    protected $table = 'settings';

    // Allow mass assignment for key and value
  protected $fillable = [
    'company_name', 'copyright_text',
    'description', 'registration_number',
    'trade_license', 'vat_number',
    'contact_number', 'whatsapp_number', 'hotline_number',
    'email', 'alt_email', 'website',
    'linkedin', 'facebook', 'landing_page', 'google_map', 'address',
    'logo_dark', 'logo_light', 'favicon',
];

    // No timestamps (unless you’ve added them in the migration)
    public $timestamps = false;

    /**
     * Retrieve a setting value by key
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value by key
     */
    public static function setValue(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
