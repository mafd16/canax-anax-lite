<?php
$urlStatus = $app->url->create("status");
$guess = $app->url->create("../../kmom01/guess/index");
?>

</div>

<h1>Om</h1>
<p>Detta är min Me-sida i kursen OOPHP, som ges på distans vid BTH. I kursen
    bygger vi ett ramverk från grunden.</p>
<p>Denna sidan finns på mitt Github-konto, <a href="https://github.com/mafd16/canax-anax-lite">här!</a></p>


<figure>
    <img src="image/ramverk.jpg?w=300&rb=-90" alt="ramverk">
    <figcaption>Ett annat slags ramverk...</figcaption>

</figure>

<br>

<p>Detaljer om systemet finner du <a href="<?= $urlStatus ?>">här!</a></p>
<p>Spela <a href="<?= $guess ?>">guess my number</a>.</p>
