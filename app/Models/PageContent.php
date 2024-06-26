<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function values()
    {
        return $this->hasMany(PageContentValue::class, 'page_content_id');
    }
}
