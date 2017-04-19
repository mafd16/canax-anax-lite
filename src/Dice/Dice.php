<?php

namespace Marton\Dice;

/**
 * Dice game 100.
 */
class Dice
{
    /**
     * The players total score.
     */
    private $playerOne;
    private $playerTwo;

    /**
     * The player in turn.
     */
    private $playerInTurn = 1;

    /**
     * The current sum of the player in turn.
     */
    private $currentSum;

    /**
     * The result of the last roll made.
     */
    private $lastRoll;

    /**
     * Show last roll made.
     *
     * @return int random number 1 to 6.
     */
    public function showLastRoll()
    {
        return $this->lastRoll;
    }

    /**
     * Set last roll to zero.
     */
    public function zeroLastRoll()
    {
        $this->lastRoll = null;
    }

    /**
     * Throw the dice.
     *
     * @return int random number 1 to 6.
     */
    public function throwDice()
    {
        $this->lastRoll = rand(1, 6);
        return $this->lastRoll;
    }

    /**
     * Change player in turn.
     */
    public function changePlayer()
    {
        if ($this->playerInTurn == 1) {
            $this->playerInTurn = 2;
        } elseif ($this->playerInTurn == 2) {
            $this->playerInTurn = 1;
        }
    }

    /**
     * Show player in turn.
     */
    public function showPlayerInTurn()
    {
        return $this->playerInTurn;
    }

    /**
     * Show total score of player.
     *
     * @param int player 1 or 2.
     */
    public function showTotalScore($player)
    {
        if ($player == 1) {
            return $this->playerOne;
        } elseif ($player == 2) {
            return $this->playerTwo;
        } else {
            return "No such player";
        }
    }

    /**
     * Stop and save sum to total score.
     */
    public function stopAndSave()
    {
        if ($this->showPlayerInTurn() == 1) {
            $this->playerOne += $this->currentSum;
        } elseif ($this->showPlayerInTurn() == 2) {
            $this->playerTwo += $this->currentSum;
        }
        $this->currentSum = 0;
    }

    /**
     * Show current sum.
     */
    public function showCurrentSum()
    {
        return $this->currentSum;
    }

    /**
     * Add to current sum.
     *
     * @param int.
     */
    public function addToCurrentSum($point)
    {
        $this->currentSum += $point;
    }

    /**
     * Set current sum to zero.
     */
    public function zeroCurrentSum()
    {
        $this->currentSum = null;
    }
}
