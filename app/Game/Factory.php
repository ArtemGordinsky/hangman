<?php

namespace App\Game;

use App\Game;

class Factory
{
    /**
     * @return Game
     */
    public static function make()
    {
        return new Game(
            new Player,
            new HiddenWord(self::chooseRandomWord())
        );
    }

    protected static function chooseRandomWord() {
        return collect(config('app.game.allowed_words_list'))
            ->random();
    }
}