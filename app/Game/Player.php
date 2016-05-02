<?php

namespace App\Game;

use App\Exceptions\Game\PlayerIsOutOfLivesException;
use App\Exceptions\Game\RepeatedGuessException;
use App\Interfaces\Game\Player as PlayerInterface;
use Illuminate\Support\Collection;

class Player implements PlayerInterface
{
    const NUM_LIVES_INITIAL_DEFAULT = 5;

    /** @var int */
    protected $numLivesInitial;

    /** @var int */
    protected $numLivesRemaining;

    /** @var Collection */
    protected $guesses;

    public function __construct()
    {
        $this->numLivesInitial = (int) config(
            'app.game.num_player_lives_initial',
            self::NUM_LIVES_INITIAL_DEFAULT
        );

        $this->numLivesRemaining = $this->numLivesInitial;
        $this->guesses = collect([]);
    }

    /**
     * @throws PlayerIsOutOfLivesException
     */
    public function decrementNumLives()
    {
        if ($this->numLivesRemaining === 0) {
            throw new PlayerIsOutOfLivesException;
        }

        $this->numLivesRemaining--;
    }

    /**
     * @return int
     */
    public function getNumLivesRemaining()
    {
        return $this->numLivesRemaining;
    }

    /**
     * @return int
     */
    public function getNumLivesInitial()
    {
        return $this->numLivesInitial;
    }

    /**
     * @param string $guess
     * @throws RepeatedGuessException
     */
    public function recordGuess($guess)
    {
        if ($this->guesses->contains($guess)) {
            throw new RepeatedGuessException;
        }

        $this->guesses->push($guess);
    }
}