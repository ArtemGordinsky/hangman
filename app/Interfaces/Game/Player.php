<?php

namespace App\Interfaces\Game;

use App\Exceptions\Game\PlayerIsOutOfLivesException;
use App\Exceptions\Game\RepeatedGuessException;

interface Player
{
    /**
     * @throws PlayerIsOutOfLivesException
     * @return void
     */
    public function decrementNumLives();

    /**
     * @return int
     */
    public function getNumLivesRemaining();

    /**
     * @return int
     */
    public function getNumLivesInitial();

    /**
     * @param string $guess
     * @throws RepeatedGuessException
     */
    public function recordGuess($guess);
}