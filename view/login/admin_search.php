<?php
// Include config
require_once("config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}


// is form posted? If so, get search from db
//$title = "SELECT * WHERE title";
//$view[] = "view/search-title.php";
//$view[] = "view/show-all.php";
$searchUser = getGet("searchUser");
if ($searchUser) {
    $sql = "SELECT * FROM users WHERE name LIKE ?;";
    $res = $app->database->executeFetchAll($sql, [$searchUser]);
    //$res = $app->database->getAllUsers($sql);
}




?>

<div class='profilediv'>
<hr class='leftmargin rightmargin'>
<p class='leftmargin'>Du är inloggad som: <?= $session->get("name") ?></p>




<form method="get">
    <fieldset class="leftmargin rightmargin">
    <legend>Search</legend>
    <!--<input type="hidden" name="route" value="search-title">-->
    <p>
        <label>User (use % as wildcard):
            <input type="search" name="searchUser" autofocus value="<?= htmlentities($searchUser) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    <p><a href="admin_show">Visa alla</a></p>
    </fieldset>
</form>

<?php

if ($searchUser) {
    echo "<br>";

    echo "<table class='leftmargin adminshow'>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>user</th>";
    echo "<th>firstname</th>";
    echo "<th>lastname</th>";
    echo "<th>age</th>";
    echo "<th>city</th>";
    echo "<th>prof</th>";
    echo "<th>Intres</th>";
    echo "<th>Admin</th>";
    //echo "<th>redigera</th>";
    echo "</tr>";


    foreach ($res as $row) {
        //echo "namn: {$row->name}";
        echo "<tr><td>{$row->id}</td><td>{$row->name}</td><td>{$row->firstname}</td>";
        echo "<td>{$row->lastname}</td><td>{$row->age}</td><td>{$row->city}</td>";
        echo "<td>{$row->profession}</td><td>{$row->interest}</td><td>{$row->admin}</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<br>";
}


?>



</div>
