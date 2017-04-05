<?php
$urlHome  = $app->url->create("");
$urlAbout = $app->url->create("about");
$urlReport = $app->url->create("report");

?>
<div class="header">
    <navbar>
        <a href="<?= $urlHome ?>">Hem</a> |
        <a href="<?= $urlAbout ?>">Om</a> |
        <a href="<?= $urlReport ?>">Redovisning</a>
    </navbar>
</div>
