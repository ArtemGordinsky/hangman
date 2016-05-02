<?php

use App\Game\Storage as GameStorage;

class GameStorageTest extends TestCase
{
    public function testGameStorageCreatesNewGameWhenThereIsNothingStored()
    {
        $this->assertInstanceOf(
            App\Game::class,
            GameStorage::retrieve()
        );
    }

    public function testAbleToSaveAGame()
    {
        GameStorage::save(
            GameStorage::retrieve()
        );
    }

    public function testAbleToSaveAndRetrieveAGame()
    {
        $game = GameStorage::retrieve();
        GameStorage::save($game);

        $this->assertEquals(
            GameStorage::retrieve(),
            $game
        );
    }
}
