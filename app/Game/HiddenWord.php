<?php

namespace App\Game;

use App\Interfaces\Game\GuessableWord;
use App\Interfaces\Game\Stringable;
use App\Interfaces\Game\WordLetter;
use App\Interfaces\Nullable;
use Illuminate\Support\Str;
use InvalidArgumentException;

class HiddenWord implements GuessableWord, Stringable
{
    /** @var string */
    protected $word;

    /** @var bool */
    protected $isOpen = false;

    /** @var WordLetter[] */
    protected $allLetters = [];

    /** @var WordLetter[] */
    protected $openLetters = [];

    /** @var WordLetter[] */
    protected $currentLetters = [];

    /**
     * @param string $word
     */
    public function __construct($word)
    {
        if (!is_string($word)) {
            throw new InvalidArgumentException('Invalid argument type, string expected');
        }

        $this->word = Str::lower($word);

        $this->splitWordIntoLetters();
        $this->rebuildCurrentLetters();
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->isOpen;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->word;
    }

    /**
     * @return WordLetter[]|Stringable[]
     */
    public function getCurrentLetters()
    {
        return $this->currentLetters;
    }

    /**
     * @return WordLetter[]|Stringable[]
     */
    public function getAllLetters()
    {
        return $this->allLetters;
    }

    /**
     * @param WordLetter $guessedLetter
     * @return bool
     */
    public function guessLetter(WordLetter $guessedLetter)
    {
        $letterFound = new NullHiddenWordLetter;

        foreach ($this->allLetters as $letter) {
            if ($letter->isEqual($guessedLetter)) {
                $letterFound = $letter;
                break;
            }
        }

        if (!$letterFound->isNull()) {
            $this->openLetters[] = $letterFound;
            $this->rebuildCurrentLetters();
        }

        $this->isOpen = collect($this->currentLetters)->filter(function(Nullable $letter) {
            return $letter->isNull();
        })->isEmpty();

        return !$letterFound->isNull();
    }

    /**
     * @param string $word
     * @return bool
     */
    public function guessWord($word)
    {
        if (!is_string($word)) {
            throw new InvalidArgumentException('Invalid argument type, string expected');
        }

        $guessedCorrectly = hash_equals($this->word, Str::lower($word));

        if ($guessedCorrectly) {
            // open all letters
            $this->openLetters = $this->allLetters;
            $this->isOpen = true;
            $this->rebuildCurrentLetters();
        }

        return $guessedCorrectly;
    }

    /**
     * Splits the word into HiddenWordLetter instances
     */
    protected function splitWordIntoLetters()
    {
        foreach(str_split($this->word) as $letter) {
            $this->allLetters[] = new HiddenWordLetter($letter);
        }
    }

    /**
     * Construct the array of letters
     * Open letters are recorded as instances of HiddenWordLetter;
     * Letters that haven't been opened yet are represented by instances of NullHiddenWordLetter
     */
    protected function rebuildCurrentLetters()
    {
        $this->currentLetters = [];

        foreach($this->allLetters as $letter) {
            $hiddenLetter = new NullHiddenWordLetter;

            foreach ($this->openLetters as $openLetter) {
                if ($openLetter->isEqual($letter)) {
                    $hiddenLetter = $openLetter;
                    break;
                }
            }

            $this->currentLetters[] = $hiddenLetter;
        }
    }
}