<?php
// Include config
require_once("../view/login/config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}

// Get all products
$sql = "SELECT * FROM VProducts;";
$resultset = $app->database->executeFetchAll($sql);

if (!$resultset) {
    echo "No products in database!";
}

// Get all shelfs
$sql2 = "SELECT * FROM VInventory;";
$resultset2 = $app->database->executeFetchAll($sql2);

if (!$resultset2) {
    echo "No shelfs in database!";
}

//print_r($resultset2);

?>

<div class="profilediv">

<p class="leftmargin">Administrationssida för webshopen!</p>

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

<!--
<a class="leftmargin" href='profile'>Tillbaka till Profil</a>
<a href='create_content'>Skapa nytt</a>
<a href='pages'>Visa Pages</a>
<a href='blog'>Visa Blog</a>
<a href='block'>Visa Block</a>
-->
<!--
<h3 class="leftmargin">Hantera innehåll</h3>
<hr class="leftmargin rightmargin">
<br>
-->

<a class="leftmargin" href='webshop_add_prod'>Lägg till produkt</a>
<br>
<br>
<fieldset class="leftmargin rightmargin">
    <legend>Produkter</legend>

<table class="leftmargin">
    <tr class="first">
        <!--<th>Rad</th>-->
        <th>Id</th>
        <th>Description</th>
        <th>Image</th>
        <th>Price</th>
        <th>Deleted</th>
        <!--<th>Items</th>-->
        <th>Action</th>
    </tr>
<?php //$id = -1; foreach ($resultset as $row) :
    //$id++;
?>
<?php foreach ($resultset as $row) : ?>
    <tr>
        <!--<td>$id</td>-->
        <td class="webshoptd"><?= $row->id ?></td>
        <td class="webshoptd"><?= htmlentities($row->description) ?></td>
        <td class="webshoptd"><?= htmlentities($row->image) ?></td>
        <td class="webshoptd"><?= htmlentities($row->price) ?></td>
        <td class="webshoptd"><?= htmlentities($row->deleted) ?></td>
        <!--<td class="webshoptd"> //$row->items ?></td>-->
        <td class="webshoptd"><a href='webshop_edit_prod?id=<?= $row->id ?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href='webshop_del_prod?id=<?= $row->id ?>'><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>
</fieldset>
<br>

<a class="leftmargin" href='webshop_add_inv'>Lägg produkt på hylla</a>
<br>
<br>
<fieldset class="leftmargin rightmargin">
    <legend>Lager</legend>

<table class="leftmargin">
    <tr class="first">
        <!--<th>Rad</th>-->
        <th>Id</th>
        <th>Shelf</th>
        <th>Location</th>
        <th>Items</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
<?php //$id = -1; foreach ($resultset as $row) :
    //$id++;
?>
<?php foreach ($resultset2 as $row) : ?>
    <tr>
        <!--<td>$id</td>-->
        <td class="webshoptd"><?= $row->id ?></td>
        <td class="webshoptd"><?= htmlentities($row->shelf) ?></td>
        <td class="webshoptd"><?= htmlentities($row->location) ?></td>
        <td class="webshoptd"><?= htmlentities($row->items) ?></td>
        <td class="webshoptd"><?= htmlentities($row->description) ?></td>
        <td class="webshoptd"><a href='webshop_edit_inv?id=<?= $row->id ?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href='webshop_del_inv?id=<?= $row->id ?>'><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>
</fieldset>
<br>

</div>
