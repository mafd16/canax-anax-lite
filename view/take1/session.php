<?php

// Start the session
$app->session->start();

//$app->session->dump();

// Set the counter, if not set before!
if (!($app->session->has('count'))) {
    $app->session->set('count', 0);
    //$session->set('count', $session->get('count') + 1);
}

$increase = $app->url->create("session/increment");
$decrease = $app->url->create("session/decrement");
$status = $app->url->create("session/status");
$dump = $app->url->create("session/dump");
$destroy = $app->url->create("session/destroy");

?>

</div>


<div class="showsession">
    <h1>Test the session - choose route</h1>
    <p>Current value: <?= $app->session->get('count') ?></p>
    <a href="<?= $increase ?>">/increment</a>
    <a href="<?= $decrease ?>">/decrement</a>
    <a href="<?= $status ?>">/status</a>
    <a href="<?= $dump ?>">/dump</a>
    <a href="<?= $destroy ?>">/destroy</a>
</div>
<br>
<?php
if ($app->session->has('dump')) {
    if ($app->session->get('dump')) {
        echo "<p>";
        $app->session->dump();
        echo "</p>";
        $app->session->set('dump', false);
    }
}
?>
