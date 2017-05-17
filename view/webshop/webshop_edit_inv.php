<?php
// Include config
require_once("../view/login/config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}

// if, Get updated values from POST
if (isset($_POST["doSave"])) {
    //$params gets all values from getPost()
    $params2 = getPost([
        "shelfItems",
        "shelfId"
    ]);
/*
    $params4 = getPost([
        "prodCategory",
        "prodId"
    ]);
*/
    //$sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

    // Update inventory
    $sql2 = "UPDATE `Inventory` SET items=? WHERE id=?;";

    // Update category
    //$sql4 = "UPDATE `Prod2Cat` SET cat_id=? WHERE prod_id=?;";

    //$app->database->execute($sql, array_values($params));
    try {
        $app->database->execute($sql2, array_values($params2));
        //$app->database->execute($sql4, array_values($params4));
    } catch (Exception $e) {
        //echo $e->getMessage();
        echo "<br><div class='leftmargin rightmargin alert'>";
        echo "<p>OOOpsss! ";
        echo "Något gick galet fel!</p></div>";
    }

    header("Location: webshop");
    //$invId = $params2["shelfId"];
} else {
    // Get id from querystring
    $invId = getGet('id');
}

if (!is_numeric($invId)) {
    die("Not valid for inventory id.");
}

// Get inventory with correct id
//$sql = "SELECT * FROM Inventory WHERE id = ?;";
//$inv = $app->database->executeFetch($sql, [$invId]);
/*
if (!$inv) {
    echo "No inventory entry in database!";
}
*/

// Get all shelfs
$sql = "SELECT * FROM VInventory WHERE id=?;";
$shelf = $app->database->executeFetch($sql, [$invId]);

if (!$shelf) {
    echo "No shelfs in database!";
}

// Get all categories
//$sql2 = "SELECT * FROM ProdCategory;";
//$categ = $app->database->executeFetchAll($sql2);

//print_R($categ);

//print_r($content);

?>

<div class="profilediv">

    <p class="leftmargin">Administrationssida för webshopen!</p>

    <p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

    <a class="leftmargin" href='webshop'>Tillbaka</a>

    <br>
    <br>

    <form method="POST">
        <fieldset class="leftmargin rightmargin">
            <legend>Redigera lagerhylla</legend>
            <p>
                <label>Lager-Id:<br>
                <input type="text" name="shelfId" value="<?= htmlentities($shelf->id) ?>" readonly/>
            </p>
            <p>
                <label>Location:<br>
                <input type="text" name="shelfLocation" value="<?= htmlentities($shelf->location) ?>" readonly/>
            </p>
            <p>
                <label>Product:<br>
                <input type="text" name="shelfDescription" value="<?= htmlentities($shelf->description) ?>" readonly/>
            </p>
            <p>
                <label>Items:<br>
                <input type="number" name="shelfItems" value="<?= htmlentities($shelf->items) ?>"/>
            </p>
            <input type="submit" name="doSave" value="Save">
            <input type="reset" value="Reset">
            <input type="button" onclick="location.href='webshop_del_inv?id=<?= $shelf->id ?>'" value="Delete">
        </fieldset>
    </form>
    <br>
</div>
