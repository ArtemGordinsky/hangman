<?php

namespace App\Http\Controllers;

use App\Game\Storage as GameStorage;
use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = GameStorage::retrieve();

        GameStorage::save($game);

        return view('home.index', ['game' => $game]);
    }
}
