<?php

use App\Game\HiddenWordLetter;

class HiddenWordLetterTest extends TestCase
{
    public function testHiddenWordLetterReturnsStringRepresentation()
    {
        $hiddenWord = new HiddenWordLetter('h');

        $this->assertEquals(
            $hiddenWord->toString(),
            'h'
        );
    }

    public function testHiddenWordLetterComparesToTheSameLetter()
    {
        $hiddenWord = new HiddenWordLetter('h');

        $this->assertTrue(
            $hiddenWord->isEqual(new HiddenWordLetter('h'))
        );
    }

    public function testHiddenWordLetterComparesToDifferentLetter()
    {
        $hiddenWord = new HiddenWordLetter('h');

        $this->assertFalse(
            $hiddenWord->isEqual(new HiddenWordLetter('x'))
        );
    }

    public function testHiddenWordLetterIsNotNull()
    {
        $hiddenWord = new HiddenWordLetter('h');

        $this->assertFalse(
            $hiddenWord->isNull()
        );
    }
}