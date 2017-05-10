<?php
// Route for testing my filtering functions!

$newlines = <<<EOD
Detta är min text,
som använder sig av newlines!
Nu uppe i två newlines.
Nu tre!
EOD;

$bbcode = '[b]Denna texten[/b] är skriven med [i]BBCode[/i]. [u]Här testar[/u]';
$bbcode .= ' jag diverse [url=http://wikipedia.org]saker[/url].';

$urlText = 'Här kommer några länkar: https://turfgame.com, http://dbwebb.se, ';
$urlText .= 'bth.itslearning.com. Den sista ska nog inte bli klickbar!';

$markdown = <<<EOD
Header level 1
==============

Here comes a paragraph.

* Unordered list
* Unordered list again


Header level 2
--------------

> Here comes another paragraph, now intended as blockquote.

1. Ordered list
2. Ordered list again

> This should be a blockquote.

###Header level 3

Here is a paragraph with some **bold** text and some *italic* text and a [link to dbwebb.se](http://dbwebb.se).
EOD;

$textOrig = <<<EOD
Först lite vanlig text följt av en tom rad.

Då tar vi ett nytt stycke med lite bbcode med [b]bold[/b] och [i]italic[/i] samt en [url=https://dbwebb.se]länk till dbwebb[/url].

Sen testar vi en länk till https://dbwebb.se som skall bli klickbar.

Avslutningsvis blir det en [länk skriven i markdown](https://dbwebb.se) och länken leder till dbwebb.

Avslutar med en lista som formatteras till ul/li med markdown.

* Item 1
* Item 2

EOD;


?>

<h1>Test av nl2br</h1>
<h3>Text utan filtrering:</h3>
<?= $newlines ?>
<h3>Text med filtrering:</h3>
<?= $app->textfilter->nl2br($newlines) ?>
<br>

<h1>Test av bbcode</h1>
<h3>Text utan filtrering:</h3>
<?= $bbcode ?>
<h3>Text med filtrering:</h3>
<?= $app->textfilter->bbcode2html($bbcode) ?>
<br>

<h1>Test av link</h1>
<h3>Text utan filtrering:</h3>
<?= $urlText ?>
<h3>Text med filtrering:</h3>
<?= $app->textfilter->url2link($urlText) ?>
<br>

<h1>Test av markdown</h1>
<h3>Text utan filtrering:</h3>
<?= $markdown ?>
<h3>Text med filtrering:</h3>
<?= $app->textfilter->markdown2html($markdown) ?>
<br>



<h1>Test av metod med kommaseparerade filter</h1>
<h3>Text utan filtrering:</h3>
<?= $textOrig ?>
<h3>Text med filtrering:</h3>
<?= $app->textfilter->textApplyFilters($textOrig, "bbcode,markdown,link") ?>
<br>
