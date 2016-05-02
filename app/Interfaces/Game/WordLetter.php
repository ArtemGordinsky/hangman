<?php

namespace App\Interfaces\Game;

interface WordLetter
{
    /**
     * @return bool
     */
    public function toString();

    /**
     * @param WordLetter $letter
     * @return bool
     */
    public function isEqual(WordLetter $letter);
}