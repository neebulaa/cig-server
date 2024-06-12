<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function comodities()
    {
        return $this->belongsToMany(Comodity::class, 'region_comodities', 'region_id', 'comodity_id');
    }

    public function pinpoint()
    {
        return $this->hasOne(PinPoint::class, 'region_id', 'id');
    }
}
