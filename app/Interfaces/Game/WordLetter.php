<?php

namespace App\Interfaces\Game;

interface WordLetter
{
    /**
     * @param Stringable $letter
     * @return bool
     */
    public function isEqual(Stringable $letter);
}