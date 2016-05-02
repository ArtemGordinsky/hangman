<?php

use App\Game;
use App\Game\HiddenWord;
use App\Game\Player;

class GameTest extends TestCase
{
    public function testAbleToCreateAGame()
    {
        $this->createNewGame();
    }

    public function testCreatedGameRetainsPlayer()
    {
        $player = new Player();
        $game = $this->createNewGame($player);

        $this->assertEquals(
            $player,
            $game->getPlayer()
        );
    }

    public function testCreatedGameRetainsHiddenWord()
    {
        $hiddenWord = new HiddenWord('hello');
        $game = $this->createNewGame(null, $hiddenWord);

        $this->assertEquals(
            $hiddenWord,
            $game->getHiddenWord()
        );
    }

    public function testGuessingWordLetterCorrectly()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $this->assertTrue(
            $game->guessLetter('h')
        );
    }

    public function testGuessingWordLetterIncorrectly()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $this->assertFalse(
            $game->guessLetter('x')
        );
    }

    public function testGuessingHiddenWordCorrectly()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $this->assertTrue(
            $game->guessWord('hello')
        );
    }

    public function testGuessingHiddenWordIncorrectly()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $this->assertFalse(
            $game->guessWord('good bye')
        );
    }

    public function testGuessingCorrectlyDoesNotDecreasesUserLives()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $game->guessLetter('h');
        $this->assertEquals(
            $game->getPlayer()->getNumLivesRemaining(),
            $game->getPlayer()->getNumLivesInitial()
        );
    }

    public function testGuessingIncorrectlyDecreasesUserLives()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $game->guessWord('good bye');
        $this->assertEquals(
            ($game->getPlayer()->getNumLivesInitial() - 1),
            $game->getPlayer()->getNumLivesRemaining()
        );
    }

    public function testGameIsOverWhenEntireWordIsOpen()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $game->guessWord('hello');

        $this->assertTrue($game->isOver());
    }

    public function testGameIsOverWhenAllWordLettersAreOpen()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        $game->guessLetter('h');
        $game->guessLetter('e');
        $game->guessLetter('l');
        $game->guessLetter('o');

        $this->assertTrue($game->isOver());
    }

    public function testGameIsOverWhenUserIsDead()
    {
        $game = $this->createNewGame(
            null,
            new HiddenWord('hello')
        );

        for($i = 0; $i < $game->getPlayer()->getNumLivesInitial(); $i++) {
            $game->guessLetter((string) $i);
        }

        $this->assertTrue($game->isOver());
    }

    /**
     * @param Player $player
     * @param HiddenWord $hiddenWord
     * @return Game
     */
    protected function createNewGame(Player $player = null, HiddenWord $hiddenWord = null) {
        return new Game(
            $player ? $player : new Player,
            $hiddenWord ? $hiddenWord : new HiddenWord('hello')
        );
    }
}
