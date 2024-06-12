<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function getPublicProfileImageAttribute()
    {
        return $this->profile_image ? asset("images/{$this->profile_image}") : asset('images/profile-image-default.jpg');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
