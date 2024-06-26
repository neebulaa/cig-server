<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinpoint extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
