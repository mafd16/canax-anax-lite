<?php
// Include config
require_once("../view/login/config.php");


/*
CASE
    WHEN (deleted <= NOW()) THEN "isDeleted"
    WHEN (published <= NOW()) THEN "isPublished"
    ELSE "notPublished"
END AS status
*/

$sql = <<<EOD
SELECT
*
FROM content
WHERE
    type=?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;

$resultset = $app->database->executeFetchAll($sql, ["block"]);


if (!$resultset) {
    echo "<br>";
    die("<p class='leftmargin'>No block-entry published!</p>");
}

?>

<div class="profilediv">

<br>
    <h1 class="leftmargin">Blocks</h1>

    <?php foreach ($resultset as $row) : ?>
        <div class="block">
            <?= $app->textfilter->textApplyFilters(htmlentities($row->data), htmlentities($row->filter)) ?>
        </div>
    <?php endforeach; ?>
<br>


</div>
