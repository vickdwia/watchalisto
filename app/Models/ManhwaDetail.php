<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManhwaDetail extends Model
{
    protected $fillable = [
        'media_id',
        'total_chapter',
        'total_volume',
    ];

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
