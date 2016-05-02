<?php

namespace App\Game;

use App\Interfaces\Game\Stringable;
use App\Interfaces\Game\WordLetter;
use App\Interfaces\Nullable;

class NullHiddenWordLetter implements WordLetter, Nullable, Stringable
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

    /**
     * @return string
     */
    public function toString()
    {
        return '';
    }

    /**
     * @letter Stringable
     * @return bool
     */
    public function isEqual(Stringable $letter)
    {
        return false;
    }
}