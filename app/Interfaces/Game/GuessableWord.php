<?php

namespace App\Interfaces\Game;

interface GuessableWord
{
    /**
     * @return WordLetter[]
     */
    public function getCurrentLetters();

    /**
     * @param WordLetter $guessedLetter
     * @return bool
     */
    public function guessLetter(WordLetter $guessedLetter);

    /**
     * @param string $word
     * @return bool
     */
    public function guessWord($word);

    /**
     * @return bool
     */
    public function isOpen();
}