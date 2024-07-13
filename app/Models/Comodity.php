<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comodity extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    protected $hidden = ['pivot'];

    public function getPublicIconAttribute()
    {
        return asset("images/{$this->icon}");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'region_comodities', 'comodity_id', 'region_id');
    }

    protected $appends = ['public_icon'];
}
