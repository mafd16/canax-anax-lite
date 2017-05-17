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
    $params3 = getPost([
        "prodDesc",
        "prodImage",
        "prodPrice",
        "prodId",
    ]);

    $params4 = getPost([
        "prodCategory",
        "prodId"
    ]);

    //$sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";

    // Update product
    $sql3 = "UPDATE `Product` SET description=?, image=?, price=? WHERE id=?;";

    // Update category
    $sql4 = "UPDATE `Prod2Cat` SET cat_id=? WHERE prod_id=?;";

    //$app->database->execute($sql, array_values($params));
    try {
        $app->database->execute($sql3, array_values($params3));
        $app->database->execute($sql4, array_values($params4));
    } catch (Exception $e) {
        //echo $e->getMessage();
        echo "<br><div class='leftmargin rightmargin alert'>";
        echo "<p>OOOpsss! ";
        echo "Något gick galet fel!</p></div>";
        //echo "<a href='edit?id='"
        //echo '<a id="displayText" href="javascript:toggle();">Mer information</a>';
        //echo '<div id="toggleText" style="display: none"><br>' . $e->getMessage() . '</div></div>';
    }

    header("Location: webshop");
    //$prodId = $params3["prodId"];
} else {
    // Get id from querystring
    $prodId = getGet('id');
}

if (!is_numeric($prodId)) {
    die("Not valid for product id.");
}

// Get product with correct id
$sql = "SELECT * FROM VProducts WHERE id = ?;";
$prod = $app->database->executeFetch($sql, [$prodId]);

//print_R($prod);

if (!$prod) {
    echo "No such entry in database!";
}

// Get all categories
$sql2 = "SELECT * FROM ProdCategory;";
$categ = $app->database->executeFetchAll($sql2);

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
            <legend>Redigera produkt</legend>
            <p>
                <label>Id:<br>
                <input type="text" name="prodId" value="<?= htmlentities($prod->id) ?>" readonly/>
            </p>
            <p>
                <label>Description:<br>
                <input type="text" name="prodDesc" value="<?= htmlentities($prod->description) ?>"/>
            </p>
            <p>
                <label>Image:<br>
                <input type="text" name="prodImage" value="<?= htmlentities($prod->image) ?>"/>
            </p>
            <p>
                <label>Price:<br>
                <input type="text" name="prodPrice" value="<?= htmlentities($prod->price) ?>"/>
            </p>
            <p>
                <label>Category:<br>
                    <select name="prodCategory">
                        <?php foreach ($categ as $row) {
                            //print_R($row);
                            if ($prod->category == $row->category) {
                                echo '<option selected value="' . $row->id . '">' . $row->category . '</option>';
                            } else {
                                echo '<option value="' . $row->id . '">' . $row->category . '</option>';
                            }
}
                        ?>
                    </select>
            </p>
            <input type="submit" name="doSave" value="Save">
            <input type="reset" value="Reset">
            <input type="button" onclick="location.href='webshop_del_prod?id=<?= $prod->id ?>'" value="Delete">
        </fieldset>
    </form>
    <br>
</div>

<!--
<script language="javascript">
function toggle() {
    var ele = document.getElementById("toggleText");
    var text = document.getElementById("displayText");
    if(ele.style.display == "block") {
        ele.style.display = "none";
        text.innerHTML = "Mer information";
    }
    else {
        ele.style.display = "block";
        text.innerHTML = "Mindre information";
    }
}
</script>
-->
