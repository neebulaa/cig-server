<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function getPublicImageAttribute()
    {
        return asset("images/{$this->image}");
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('l, d M Y');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $appends = ['public_image', 'date'];
}
