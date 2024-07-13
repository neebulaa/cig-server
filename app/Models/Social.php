<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static $social_medias = [
        "facebook" => "socials/facebook.png",
        "instagram" => "socials/instagram.png",
        "youtube" => "socials/youtube.png",
        "tiktok" => "socials/tiktok.png",
        "linkedin" => "socials/linkedin.png",
        "twitter (X)" => "socials/x.png",
        "whatsapp" => "socials/whatsapp.png",
        "pinterest" => "socials/pinterest.png",
        "telegram" => "socials/telegram.png",
        "discord" => "socials/discord.png"
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function getPublicIconAttribute()
    {
        return asset("images/" . self::$social_medias[$this->type]);
    }

    protected $appends = ['public_icon'];
}
