<?php

namespace App\Game;

use App\Interfaces\Game\Stringable;
use App\Interfaces\Game\WordLetter;
use App\Interfaces\Nullable;
use Illuminate\Support\Str;
use InvalidArgumentException;

class HiddenWordLetter implements WordLetter, Nullable, Stringable
{
    /** @var string */
    protected $letter;

    /**
     * @param string $letter
     */
    public function __construct($letter)
    {
        if (!is_string($letter)) {
            throw new InvalidArgumentException('Invalid argument type; String expected');
        }

        if (Str::length($letter) !== 1) {
            throw new InvalidArgumentException('Invalid string length; A single letter expected');
        }

        $this->letter = Str::lower($letter);
    }

    /**
     * @return bool
     */
    public function isNull()
    {
        return false;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->letter;
    }

    /**
     * @param Stringable $letter
     * @return bool
     */
    public function isEqual(Stringable $letter)
    {
        return hash_equals($this->letter, $letter->toString());
    }
}