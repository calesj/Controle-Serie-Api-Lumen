<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class SerieController extends BaseController
{
    public function __construct()
    {
        $this->classe = Serie::class;
    }
}

