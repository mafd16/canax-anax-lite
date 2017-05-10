<?php
// Include config
require_once("../view/login/config.php");

// Get slug from querystring
$contentSlug = getGet('slug');


$sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;

//$slug = substr($route, 5);


$content = $app->database->executeFetch($sql, [$contentSlug, "post"]);

if (!$content) {
    echo "<br>";
    die("<p class='leftmargin'>No such entry published!</p>");
}

?>


<div class="profilediv">

<br>
<h3 class="leftmargin">The blog!</h3>
<hr class="leftmargin rightmargin">
<br>

<article class="leftmargin rightmargin">


<section>
    <header>
        <h1><?= htmlentities($content->title) ?></h1>
        <p><i>Published: <time datetime="<?= htmlentities($content->published_iso8601) ?>" pubdate><?= htmlentities($content->published) ?></time></i></p>
    </header>
    <?= $app->textfilter->textApplyFilters(htmlentities($content->data), htmlentities($content->filter)) ?>
</section>


</article>
<br>

<a class="leftmargin" href='blog'>Tillbaka</a>

<br>

</div>
