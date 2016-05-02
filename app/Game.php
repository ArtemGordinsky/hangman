<?php

namespace App;

use App\Game\HiddenWordLetter;
use App\Interfaces\Game\GuessableWord;
use App\Interfaces\Game\Player;

class Game
{
    /** @var Player */
    protected $player;

    /** @var GuessableWord */
    protected $hiddenWord;

    public function __construct(Player $player, GuessableWord $hiddenWord)
    {
        $this->player = $player;
        $this->hiddenWord = $hiddenWord;
    }

    /**
     * @return GuessableWord
     */
    public function getHiddenWord()
    {
        return $this->hiddenWord;
    }

    /**
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param string $letter
     * @return bool
     * @throws Exceptions\Game\PlayerIsOutOfLivesException
     * @throws Exceptions\Game\RepeatedGuessException
     */
    public function guessLetter($letter)
    {
        $this->player->recordGuess($letter);
        $isGuessedCorrectly = $this->getHiddenWord()->guessLetter(
            new HiddenWordLetter($letter)
        );

        if (!$isGuessedCorrectly) {
            $this->getPlayer()->decrementNumLives();
        }

        return $isGuessedCorrectly;
    }

    /**
     * @param string $word
     * @return bool
     * @throws Exceptions\Game\PlayerIsOutOfLivesException
     * @throws Exceptions\Game\RepeatedGuessException
     */
    public function guessWord($word)
    {
        $this->player->recordGuess($word);
        $isGuessedCorrectly = $this->getHiddenWord()->guessWord($word);

        if (!$isGuessedCorrectly) {
            $this->getPlayer()->decrementNumLives();
        }

        return $isGuessedCorrectly;
    }

    /**
     * @return bool
     */
    public function isOver()
    {
        return ($this->hiddenWord->isOpen() || $this->player->getNumLivesRemaining() === 0);
    }
}