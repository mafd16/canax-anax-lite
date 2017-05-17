<?php
// Include config
require_once("../view/login/config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}


$prodId = getPost("prodId") ?: getGet("id");

if (!is_numeric($prodId)) {
    die("Not valid for prod id.");
}

if (isset($_POST["doDelete"])) {
    //$contentId = getPost("contentId");
    $sql = "UPDATE Product SET deleted=NOW() WHERE id=?;";
    $app->database->execute($sql, [$prodId]);
    header("Location: webshop");
    exit;
}

$sql = "SELECT id, description FROM Product WHERE id = ?;";
$prod = $app->database->executeFetch($sql, [$prodId]);

?>

<div class="profilediv">

<p class="leftmargin">Administrationssida för webshopen!</p>

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

<a class="leftmargin" href='webshop'>Tillbaka</a>


<br>
<br>

<form method="post">
    <fieldset class="leftmargin rightmargin">
    <legend>Ta bort produkt</legend>

    <p>
        <label>Id:<br>
            <input type="text" name="prodId" value="<?= htmlentities($prod->id) ?>" readonly/>
        </label>
    </p>
    <p>
        <label>Description:<br>
            <input type="text" name="prodDesc" value="<?= htmlentities($prod->description) ?>" readonly/>
        </label>
    </p>

    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>

<br>

</div>
