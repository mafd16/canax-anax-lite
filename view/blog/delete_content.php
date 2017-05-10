<?php
// Include config
require_once("../view/login/config.php");

if (!$session->has("name")) {
    header("Location: login");
}


$contentId = getPost("contentId") ?: getGet("id");

if (!is_numeric($contentId)) {
    die("Not valid for content id.");
}

if (isset($_POST["doDelete"])) {
    //$contentId = getPost("contentId");
    $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
    $app->database->execute($sql, [$contentId]);
    header("Location: content");
    exit;
}

$sql = "SELECT id, title FROM content WHERE id = ?;";
$content = $app->database->executeFetch($sql, [$contentId]);

?>

<div class="profilediv">

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>
<a class="leftmargin" href='profile'>Tillbaka till Profil</a>
<a href='content'>Hantera innehåll</a>

<br>
<br>

<form method="post">
    <fieldset class="leftmargin rightmargin">
    <legend>Delete</legend>

    <p>
        <label>Id:<br>
            <input type="text" name="contentId" value="<?= htmlentities($content->id) ?>" readonly/>
        </label>
    </p>
    <p>
        <label>Title:<br>
            <input type="text" name="contentTitle" value="<?= htmlentities($content->title) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>

</div>
