<?php
// Include config
require_once("../view/login/config.php");

if (!$session->has("name")) {
    header("Location: login");
}



if (isset($_POST["doCreate"])) {
    $title = getPost("contentTitle");

    $sql = "INSERT INTO content (title) VALUES (?);";
    $app->database->execute($sql, [$title]);
    $id = $app->database->lastInsertId();
    header("Location: edit?id=$id");
    exit;
}

?>

<div class="profilediv">

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>
<a class="leftmargin" href='profile'>Tillbaka till Profil</a>
<a href='content'>Hantera innehåll</a>
<!--<h3 class="leftmargin">Skapa nytt</h3>
<hr class="leftmargin rightmargin">-->
<br>
<br>

<form method="POST">
    <fieldset class="leftmargin rightmargin">
        <legend>Create</legend>
        <p>
            <label>Title:<br>
            <input type="text" name="contentTitle"/>
        </p>
        <input type="submit" name="doCreate" value="Create">
        <input type="reset" value="Reset">
    </fieldset>
</form>



</div>
