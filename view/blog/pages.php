<?php
// Include config
require_once("../view/login/config.php");


$sql = <<<EOD
SELECT
*,
CASE
    WHEN (deleted <= NOW()) THEN "isDeleted"
    WHEN (published <= NOW()) THEN "isPublished"
    ELSE "notPublished"
END AS status
FROM content
WHERE type=?
;
EOD;

$resultset = $app->database->executeFetchAll($sql, ["page"]);




?>

<div class="profilediv">

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>
<a class="leftmargin" href='profile'>Tillbaka till Profil</a>
<a href='content'>Hantera innehåll</a>


<br>
<br>


<fieldset class="leftmargin rightmargin">
    <legend>Pages</legend>
    <table><!-- leftmargin">-->
        <tr class="first">
            <th>Id</th>
            <th>Title</th>
            <th>Type</th>
            <th>Status</th>
            <th>Published</th>
            <th>Deleted</th>
        </tr>
    <?php //$id = -1; foreach ($resultset as $row) :
        //$id++;
    ?>
    <?php foreach ($resultset as $row) : ?>
        <tr>
            <td><?= $row->id ?></td>
            <td><a href='page?id=<?= $row->id ?>'><?= $row->title ?></a></td>
            <td><?= $row->type ?></td>
            <td><?= $row->status ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->deleted ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</fieldset>

<br>


</div>
