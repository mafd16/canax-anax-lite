<?php
$app->diceSession  = new \Marton\Session\Session('martindice');
$app->diceSession->start();

if ($app->diceSession->has('diceobj')) {
    $dice = $app->diceSession->get('diceobj');
} else {
    $dice = new \Marton\Dice\Dice();
}

// Restart the game
if (isset($_GET['restart'])) {
    $app->diceSession->destroy();
    unset($GLOBALS['restart']);
    $app->response->redirect($app->url->create("dice"));
}

// Zero messages
$message = "";

// Links
$rollDice = $app->url->create("dice?roll=true");
$save = $app->url->create("dice?save=true");
$restart = $app->url->create("dice?restart=true");

// Roll the dice:
if (isset($_GET['roll'])) {
    $dice->throwDice();
    if ($dice->showLastRoll() == 1) {
        $dice->zeroCurrentSum();
        //$dice->zeroLastRoll();
        $dice->changePlayer();
        $message = "You rolled a 1. Next players turn!";
        //echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $dice->addToCurrentSum($dice->showLastRoll());
        $message = "";
        //$message = "Good roll! Keep playing, or save your points.";
    }
    unset($GLOBALS['roll']);
}

// Save current round
if (isset($_GET['save'])) {
    unset($GLOBALS['save']);
    $dice->stopAndSave(); // move curr sum to player // currSum -> 0
    $dice->zeroLastRoll(); // LastRoll -> 0
    if ($dice->showTotalScore($dice->showPlayerInTurn()) >= 100) {
        $message = "Player ";
        $message .= $dice->showPlayerInTurn();
        $message .= " is the winner!";
        $rollDice = "";
        $save = "";
    } else {
        $dice->changePlayer(); // Change player
        $message = "Points saved! Next players turn!";
    }
}


// Save the diceobject to the diceSession
$app->diceSession->set('diceobj', $dice);
?>

</div>


<h1 class="diceheading">Dicegame 100</h1>

<div class="totalscore">
    <h2>Total score</h2>
    <p>Player 1: <?= $dice->showTotalScore(1) ?></p>
    <p>Player 2: <?= $dice->showTotalScore(2) ?></p>
    <a></a>
</div>

<div class="diceroom">

</div>

<div class="dicegame">
    <h2>Player <?= $dice->showPlayerInTurn(); ?></h2>
    <p>Points from dice: <?= $dice->showLastRoll(); ?></p>
    <p>Sum of points: <?= $dice->showCurrentSum(); ?></p>
    <a href="<?= $rollDice ?>">Roll dice</a> | <a href="<?= $save ?>">Save to score</a>

</div>

<div class="dicemessages">
    <h2>Messages</h2>
    <p><?= $message ?></p>
</div>

<div class="dicerules">
    <h2>Rules</h2>
    <p>Collect points from dice to get first to at least 100.
    Roll dice until you choose to stop and save. If you get a "1",
    you will loose your points from the round, and it will be the
    next players turn!</p>
</div>

<div class="restartdice">
    <a href="<?= $restart ?>">Restart game</a>
</div>

<br>
<?php
if ($dice->showLastRoll() == 1) {
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>
