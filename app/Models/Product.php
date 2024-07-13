<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function comodities()
    {
        return $this->belongsToMany(Comodity::class, 'product_comodities', 'product_id', 'comodity_id');
    }

    public function getPublicImageAttribute()
    {
        return asset("images/{$this->image}");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $appends = ['public_image'];
}
