<?php
// Include config
require_once("../view/login/config.php");




$sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
    FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;

$resultset = $app->database->executeFetchAll($sql, ["post"]);


if (!$resultset) {
    return;
}




?>

<div class="profilediv">

<br>
<h3 class="leftmargin">The blog!</h3>
<hr class="leftmargin rightmargin">
<br>

<article class="leftmargin rightmargin">

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h1><a href="blogentry?slug=<?= htmlentities($row->slug) ?>"><?= htmlentities($row->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= htmlentities($row->published_iso8601) ?>" pubdate><?= htmlentities($row->published) ?></time></i></p>
    </header>
    <?= $app->textfilter->textApplyFilters(substr(htmlentities($row->data), 0, strlen($row->data) < 100 ? strlen($row->data) : 100) . "...", htmlentities($row->filter)) ?>
</section>
<?php endforeach; ?>

</article>

<br>

</div>
