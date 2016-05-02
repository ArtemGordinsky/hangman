<?php

namespace App\Http\Controllers;

use App\Exceptions\Game\RepeatedGuessException;
use App\Game;
use App\Game\Storage as GameStorage;
use Flash;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Str;

class GuessController extends Controller
{
    public function make(Request $request)
    {
        $this->validate(
            $request,
            ['letter_or_word' => 'bail|string|required|max:25']
        );

        $game = GameStorage::retrieve();
        $letterOrWord = $request->get('letter_or_word');

        try {
            if (Str::length($letterOrWord) === 1) {
                $isGuessedCorrectly = $this->guessLetter($game, $letterOrWord);
            } else {
                $isGuessedCorrectly = $this->guessWord($game, $letterOrWord);
            }
        } catch (RepeatedGuessException $e) {
            Flash::error("You've already guessed this! Come up with something new.");
            return redirect()->back();
        }

        if (!$isGuessedCorrectly) {
            if ($game->isOver()) {
                Flash::warning("Oh noes, you're out of lives! Restart the game to try your luck again!");
            } else {
                $numLivesRemaining = $game->getPlayer()->getNumLivesRemaining();
                $lifeSingularOrPlural = ($numLivesRemaining === 1 ? 'life' : 'lives');
                Flash::warning("No luck, sorry! {$numLivesRemaining} {$lifeSingularOrPlural} left.");
            }
        }

        GameStorage::save($game);

        return redirect()->back();
    }

    /**
     * @param Game $game
     * @param $letter
     * @return bool
     */
    protected function guessLetter(Game $game, $letter) {
        $isGuessedCorrectly = $game->guessLetter($letter);

        if ($isGuessedCorrectly) {
            if ($game->isOver()) {
                Flash::info("Great job! You opened all letters! Restart the game to try the next word.");
            } else {
                $letterOrNumber = (is_numeric($letter) ? 'number' : 'letter');
                Flash::info("Great job! You opened {$letterOrNumber} \"{$letter}\"!");
            }
        }

        return $isGuessedCorrectly;
    }

    /**
     * @param Game $game
     * @param $word
     * @return bool
     */
    protected function guessWord(Game $game, $word) {
        $isGuessedCorrectly = $game->guessWord($word);

        if ($isGuessedCorrectly) {
            Flash::info('Great job! You opened the entire word! Restart the game to try the next one.');
        }

        return $isGuessedCorrectly;
    }
}
