<?php
// Include config
require_once("../view/login/config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}


if (isset($_POST["doCreate"])) {
    $params3 = getPost([
        "invProdId",
        "invShelfId",
        "invItems"
    ]);

    $sql3 = "INSERT INTO Inventory (prod_id, shelf_id, items) VALUES (?, ?, ?);";
    $app->database->execute($sql3, array_values($params3));
    //$id = $app->database->lastInsertId();

    /*
    $params3 = [
        $id,
        getPost("prodCategory")
    ];
    */

    //$sql3 = "INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES (?,?);";
    //$app->database->execute($sql3, array_values($params3));

    //print_r($id);
    //print_r($desc);
    //header("Location: webshop_edit_prod?id=$id");
    header("Location: webshop");
    exit;
}

// Get all products
$sql1 = "SELECT * FROM Product;";
$prod = $app->database->executeFetchAll($sql1);

// Get all shelfs
$sql2 = "SELECT * FROM InvenShelf;";
$shelf = $app->database->executeFetchAll($sql2);

?>

<div class="profilediv">

<p class="leftmargin">Administrationssida för webshopen!</p>

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

<a class="leftmargin" href='webshop'>Tillbaka</a>

<!--<h3 class="leftmargin">Skapa nytt</h3>
<hr class="leftmargin rightmargin">-->
<br>
<br>

<form method="POST">
    <fieldset class="leftmargin rightmargin">
        <legend>Lägg produkt på hylla</legend>
        <p>
            <label>Välj produkt: (id, description)<br>
                <select required name="invProdId">
                    <option value=""></option>
                    <?php foreach ($prod as $row) {
                        //print_R($row);
                        echo '<option value="' . $row->id . '">' . $row->id . ", " . $row->description . '</option>';
}
                    ?>
                </select>
            <!--<input type="text" name="prodDesc" required autofocus/>-->
        </p>
        <p>
            <label>att lägga på hylla:<br>
                <select required name="invShelfId">
                    <option value=""></option>
                    <?php foreach ($shelf as $row) {
                        //print_R($row);
                        echo '<option value="' . $row->shelf . '">' . $row->description . '</option>';
}
                    ?>
                </select>
        </p>
        <p>
            <label>Antal av produkten:<br>
            <input required type="number" name="invItems"/>
        </p>
        <input type="submit" name="doCreate" value="Create">
        <input type="reset" value="Reset">
    </fieldset>
</form>

<br>

</div>
