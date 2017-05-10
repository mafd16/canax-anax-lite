<?php
// Include config
require_once("../view/login/config.php");

// Get id from querystring
$contentId = getGet('id');

if (!is_numeric($contentId)) {
    die("Not valid for content id.");
}

// Get content with correct id
//$sql = "SELECT * FROM content WHERE id = ?;";

$sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    id = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

$content = $app->database->executeFetch($sql, [$contentId, "page"]);

//$content = $app->database->executeFetch($sql, [$contentId]);

if (!$content) {
    echo "<br>";
    die("<p class='leftmargin'>No such entry published!</p>");
}



?>

<div class="profilediv">
    <article class="leftmargin">
        <header>
            <h1><?= htmlentities($content->title) ?></h1>
            <p><i>Latest update: <time datetime="<?= htmlentities($content->modified_iso8601) ?>" pubdate><?= htmlentities($content->modified) ?></time></i></p>
        </header>
        <?= $app->textfilter->textApplyFilters(htmlentities($content->data), htmlentities($content->filter)) ?>
    </article>




</div>
