<?php

namespace App\Game;

use App\Game;
use Session;

class Storage
{
    /**
     * @return Game
     */
    public static function retrieve()
    {
        return Session::get(Game::class, Factory::make());
    }

    public static function save(Game $game)
    {
        Session::set(Game::class, $game);
    }
}