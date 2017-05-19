<?php

namespace Marton\Dice;

/**
 * Test cases for class Dice.
 */
//class GuessDice extends \PHPUnit_Framework_TestCase
class DiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test case to check if thrown dice value equals showLastRoll.
     */
    public function testThrowDice()
    {
        $dice = new Dice();
        $this->assertEquals($dice->throwDice(), $dice->showLastRoll());
    }


    /**
     * Test case to check that zeroLastRoll sets lastroll to null.
     */
    public function testZeroLastRoll()
    {
        $dice = new Dice();
        $dice->throwDice();
        $this->assertNotEmpty($dice->showLastRoll());

        $dice->zeroLastRoll();
        $this->assertEquals(null, $dice->showLastRoll());
    }


    /**
     * Test case to check if changePlayer changes player
     * and that showPlayerInTurn shows player in turn.
     */
    public function testChangePlayer()
    {
        $dice = new Dice();
        $this->assertEquals(1, $dice->showPlayerInTurn());
        $dice->changePlayer();
        $this->assertEquals(2, $dice->showPlayerInTurn());
        $dice->changePlayer();
        $this->assertEquals(1, $dice->showPlayerInTurn());
    }


    /**
     * Test case to check that showTotalScore returns
     * correct error-message when wrong player is entered.
     */
    public function testShowTotalScore()
    {
        $dice = new Dice();
        $this->assertEquals("No such player", $dice->showTotalScore(3));
    }


    /**
     * Test case to check current sum function
     * addToCurrentSum.
     */
    public function testAddToCurrentSum()
    {
        $dice = new Dice();
        $dice->addToCurrentSum(4);
        $this->assertEquals(4, $dice->showCurrentSum(1));
    }


    /**
     * Test case to check current sum function
     * zeroCurrentSum.
     */
    public function testZeroCurrentSum()
    {
        $dice = new Dice();
        $dice->addToCurrentSum(4);
        $this->assertEquals(4, $dice->showCurrentSum(1));
        $dice->zeroCurrentSum();
        $this->assertEquals(null, $dice->showCurrentSum(1));
    }


    /**
     * Test case to check stopAndSave
     *
     */
    public function testStopAndSave()
    {
        $dice = new Dice();
        $dice->addToCurrentSum(4);
        $dice->stopAndSave();
        $this->assertEquals(4, $dice->showTotalScore(1));
        $dice->changePlayer();
        $dice->addToCurrentSum(12);
        $dice->stopAndSave();
        $this->assertEquals(12, $dice->showTotalScore(2));
    }
}
