<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMediaList extends Model
{
    protected $fillable = [
        'user_id',
        'media_id',
        'status',
        'progress',
        'rating',
        'started_date',
        'finished_date',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
