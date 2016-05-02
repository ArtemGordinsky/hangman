<?php

namespace App\Game;

use App\Interfaces\Game\WordLetter;
use App\Interfaces\Nullable;

class NullHiddenWordLetter implements WordLetter, Nullable
{
    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return true;
    }

    public function toString()
    {
        return '';
    }

    /**
     * @letter WordLetter
     * @return bool
     */
    public function isEqual(WordLetter $letter)
    {
        return false;
    }
}