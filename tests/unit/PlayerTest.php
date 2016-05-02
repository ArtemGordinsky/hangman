<?php

use App\Game\Player;

class PlayerTest extends TestCase
{
    public function testPlayerReturnsNumberOfRemainingLives()
    {
        $player = new Player;

        $this->assertTrue(
            is_int($player->getNumLivesRemaining())
        );
    }

    public function testPlayerReturnsNumberOfInitialLives()
    {
        $player = new Player;

        $this->assertTrue(
            is_int($player->getNumLivesInitial())
        );
    }

    public function testNewPlayersRemainingLivesEqualInitialLives()
    {
        $player = new Player;

        $this->assertEquals(
            $player->getNumLivesRemaining(),
            $player->getNumLivesInitial()
        );
    }

    public function testPlayerDecrementsLives()
    {
        $player = new Player;
        $player->decrementNumLives();

        $this->assertEquals(
            ($player->getNumLivesInitial() - 1),
            $player->getNumLivesRemaining()
        );
    }

    public function testPlayerPreventsRepetitiveGuesses()
    {
        $this->setExpectedException(App\Exceptions\Game\RepeatedGuessException::class);

        $player = new Player;
        $player->recordGuess('guess');
        $player->recordGuess('guess');
    }

    public function testPlayerPreventsDecrementingLivesBelowZero()
    {
        $this->setExpectedException(App\Exceptions\Game\PlayerIsOutOfLivesException::class);

        $player = new Player;

        for($i = -1; $i < $player->getNumLivesInitial(); $i++) {
            $player->decrementNumLives();
        }
    }
}
