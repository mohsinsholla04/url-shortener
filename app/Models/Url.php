<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'original_url',
        'short_code',
    ];

    // Generate a random short code
    public static function generateShortCode()
    {
        do {
            // Create a random 6-character code
            $shortCode = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
        } while (self::where('short_code', $shortCode)->exists());

        return $shortCode;
    }
}
