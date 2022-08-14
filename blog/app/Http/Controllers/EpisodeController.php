<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;

class EpisodeController extends BaseController
{
    public function __construct()
    {
        $this->classe = Episode::class;
    }

    public function searchForSerie($serieId)
    {
        $episodios = Episode::query()
            ->where('serie_id', $serieId)->paginate();
        return $episodios;
    }
}

