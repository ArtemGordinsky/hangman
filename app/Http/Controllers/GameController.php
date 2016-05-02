<?php

namespace App\Http\Controllers;

use App\Game\Factory;
use App\Game\Storage as GameStorage;

use App\Http\Requests;

class GameController extends Controller
{
    public function restart()
    {
        GameStorage::save(Factory::make());

        return back();
    }
}
