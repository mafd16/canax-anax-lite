<?php
// Include config
require_once("../view/login/config.php");

if (!$session->has("name")) {
    header("Location: login");
}


// Get all from content
$sql = "SELECT * FROM content;";
$resultset = $app->database->executeFetchAll($sql);

if (!$resultset) {
    echo "No data in database!";
}

?>

<div class="profilediv">

<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

<a class="leftmargin" href='profile'>Tillbaka till Profil</a>
<a href='create_content'>Skapa nytt</a>
<a href='pages'>Visa Pages</a>
<a href='blog'>Visa Blog</a>
<a href='block'>Visa Block</a>


<h3 class="leftmargin">Hantera innehåll</h3>
<hr class="leftmargin rightmargin">
<br>

<table class="smallfont"><!-- leftmargin">-->
    <tr class="first">
        <!--<th>Rad</th>-->
        <th>Id</th>
        <th>Title</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Path</th>
        <th>Slug</th>
        <th>Action</th>
    </tr>
<?php //$id = -1; foreach ($resultset as $row) :
    //$id++;
?>
<?php foreach ($resultset as $row) : ?>
    <tr>
        <!--<td>$id</td>-->
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <td><a href='edit?id=<?= $row->id ?>'><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href='delete_content?id=<?= $row->id ?>'><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>

<br>

</div>
