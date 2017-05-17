<?php
// Include config
require_once("../view/login/config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}


if (isset($_POST["doCreate"])) {
    $params1 = getPost([
        "prodDesc",
        "prodImage",
        "prodPrice"
    ]);



    $sql1 = "INSERT INTO Product (description, image, price) VALUES (?, ?, ?);";
    $app->database->execute($sql1, array_values($params1));
    $id = $app->database->lastInsertId();

    $params3 = [
        $id,
        getPost("prodCategory")
    ];

    $sql3 = "INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES (?,?);";
    $app->database->execute($sql3, array_values($params3));

    //print_r($id);
    //print_r($desc);
    //header("Location: webshop_edit_prod?id=$id");
    header("Location: webshop");
    exit;
}

// Get all categories
$sql2 = "SELECT * FROM ProdCategory;";
$categ = $app->database->executeFetchAll($sql2);

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
        <legend>Lägg till produkt</legend>
        <p>
            <label>Description:<br>
            <input type="text" name="prodDesc" required autofocus/>
        </p>
        <p>
            <label>Image:<br>
            <input type="text" name="prodImage"/>
        </p>
        <p>
            <label>Price:<br>
            <input type="text" name="prodPrice"/>
        </p>
        <p>
            <label>Category:<br>
                <select name="prodCategory">
                    <?php foreach ($categ as $row) {
                        //print_R($row);
                        echo '<option value="' . $row->id . '">' . $row->category . '</option>';
}
                    ?>
                </select>
        </p>
        <input type="submit" name="doCreate" value="Create">
        <input type="reset" value="Reset">
    </fieldset>
</form>

<br>

</div>
