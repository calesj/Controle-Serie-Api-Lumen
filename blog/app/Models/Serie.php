<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $fillable = ['description'];
    protected $appends = ['links'];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function getLinksAttribute($links): array
    {
        return [
            'episodio' => '/api/series/' . $this->id . '/episodes',
            'links' => '/api/series/' . $this->serie_id
        ];
    }
}
