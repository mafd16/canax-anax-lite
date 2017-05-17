<?php
// Include config
require_once("../view/login/config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}


$invId = getPost("invId") ?: getGet("id");

if (!is_numeric($invId)) {
    die("Not valid for inventory id.");
}

if (isset($_POST["doDelete"])) {
    //$contentId = getPost("contentId");
    $sql2 = "DELETE FROM Inventory WHERE id=?;";
    $app->database->execute($sql2, [$invId]);
    header("Location: webshop");
    exit;
}

$sql = "SELECT * FROM VInventory WHERE id = ?;";
$inv = $app->database->executeFetch($sql, [$invId]);

?>

<div class="profilediv">

<p class="leftmargin">Administrationssida för webshopen!</p>

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

<a class="leftmargin" href='webshop'>Tillbaka</a>


<br>
<br>

<form method="post">
    <fieldset class="leftmargin rightmargin">
    <legend>Ta bort produkt från hylla</legend>
    <p>
        <label>Id:<br>
            <input type="text" name="invId" value="<?= htmlentities($inv->id) ?>" readonly/>
        </label>
    </p>
    <p>
        <label>Shelf:<br>
            <input type="text" name="invShelf" value="<?= htmlentities($inv->shelf) ?>" readonly/>
        </label>
    </p>
    <p>
        <label>Location:<br>
            <input type="text" name="invLocation" value="<?= htmlentities($inv->location) ?>" readonly/>
        </label>
    </p>
    <p>
        <label>Items:<br>
            <input type="text" name="invItems" value="<?= htmlentities($inv->items) ?>" readonly/>
        </label>
    </p>
    <p>
        <label>Description:<br>
            <input type="text" name="invDescription" value="<?= htmlentities($inv->description) ?>" readonly/>
        </label>
    </p>
    <p>
        <button type="submit" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </p>
    </fieldset>
</form>

<br>

</div>
