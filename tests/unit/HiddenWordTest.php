<?php

use App\Game\HiddenWord;
use App\Game\HiddenWordLetter;
use App\Game\NullHiddenWordLetter;

class HiddenWordTest extends TestCase
{
    public function testHiddenWordReturnsStringRepresentation()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertEquals(
            $hiddenWord->toString(),
            'hello'
        );
    }

    public function testGuessingHiddenWordLetterIncorrectly()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertFalse(
            $hiddenWord->guessLetter(new NullHiddenWordLetter)
        );
    }

    public function testHiddenWordReturnsAllLetters()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertEquals('h', $hiddenWord->getAllLetters()[0]->toString());
        $this->assertEquals('e', $hiddenWord->getAllLetters()[1]->toString());
        $this->assertEquals('l', $hiddenWord->getAllLetters()[2]->toString());
        $this->assertEquals('l', $hiddenWord->getAllLetters()[3]->toString());
        $this->assertEquals('o', $hiddenWord->getAllLetters()[4]->toString());
    }

    public function testAllHiddenWordCurrentLettersStartOutHidden()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertEquals('', $hiddenWord->getCurrentLetters()[0]->toString());
        $this->assertEquals('', $hiddenWord->getCurrentLetters()[1]->toString());
        $this->assertEquals('', $hiddenWord->getCurrentLetters()[2]->toString());
        $this->assertEquals('', $hiddenWord->getCurrentLetters()[3]->toString());
        $this->assertEquals('', $hiddenWord->getCurrentLetters()[4]->toString());
    }

    public function testGuessingHiddenWordLetterCorrectly()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertTrue(
            $hiddenWord->guessLetter(new HiddenWordLetter('o'))
        );
    }

    public function testGuessingHiddenWordIncorrectly()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertFalse(
            $hiddenWord->guessWord('good bye')
        );
    }

    public function testGuessingHiddenWordCorrectly()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertTrue(
            $hiddenWord->guessWord('hello')
        );
    }

    public function testHiddenWordIsNotOpenOnCreation()
    {
        $hiddenWord = new HiddenWord('hello');

        $this->assertFalse($hiddenWord->isOpen());
    }

    public function testOpeningAllWordLetters()
    {
        $hiddenWord = new HiddenWord('hello');

        $hiddenWord->guessLetter(new HiddenWordLetter('h'));
        $hiddenWord->guessLetter(new HiddenWordLetter('e'));
        $hiddenWord->guessLetter(new HiddenWordLetter('l'));
        $hiddenWord->guessLetter(new HiddenWordLetter('o'));

        $this->assertTrue($hiddenWord->isOpen());
    }

    public function testOpeningEntireWord()
    {
        $hiddenWord = new HiddenWord('hello');

        $hiddenWord->guessWord('hello');

        $this->assertTrue($hiddenWord->isOpen());
    }
}