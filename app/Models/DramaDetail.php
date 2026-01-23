<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DramaDetail extends Model
{
    protected $fillable = [
        'media_id',
        'total_episode',
        'total_season',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
