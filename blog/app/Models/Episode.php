<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public $timestamps = false;
    protected $hidden = ['serie_id'];
    protected $fillable = ['episode','season', 'watch'];
    protected $appends = ['links'];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getWatchAttribute($watch): bool
    {
        return $watch;
    }

    public function getLinksAttribute() : array
    {
        return [
            'self' => '/api/episode/' . $this->id,
            'links' => '/api/series/' . $this->serie_id
        ];
    }
}
