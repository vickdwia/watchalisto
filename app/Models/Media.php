<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Media extends Model
{
    protected $fillable = [
        'title',
        'type',
        // nanti bisa ditambah kolom lain
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_media_lists')
            ->withPivot(['status', 'progress', 'rating'])
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function userLists()
    {
        return $this->hasMany(UserMediaList::class);
    }

    public function dramaDetail()
    {
        return $this->hasOne(DramaDetail::class);
    }

    public function manhwaDetail()
    {
        return $this->hasOne(ManhwaDetail::class);
    }

    public function getTotalUnitAttribute()
    {
        return match ($this->type) {
            'drama'  => optional($this->dramaDetail)->total_episode,
            'manhwa' => optional($this->manhwaDetail)->total_chapter,
            default  => null,
        };
    }
}
