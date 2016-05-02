<?php

use App\Game\Factory;

class GameFactoryTest extends TestCase
{
    public function testGameFactoryCreatesNewGameSuccessfully()
    {
        $this->assertInstanceOf(
            App\Game::class,
            Factory::make()
        );
    }
}