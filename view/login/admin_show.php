<?php
// Include config
require_once("config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}

// Get sorting order:
// Only these values are valid
$columns = ["id", "name", "firstname", "lastname", "age", "city", "profession", "interest", "admin"];
$orders = ["asc", "desc"];

// Get settings from GET or use defaults
$orderBy = getGet("orderby") ?: "id";
$order = getGet("order") ?: "asc";

// Incoming matches valid value sets
if (!(in_array($orderBy, $columns) && in_array($order, $orders))) {
    die("Not valid input for sorting.");
}

//$sql = "SELECT * FROM users ORDER BY $orderBy $order;";
//$resultset = $db->executeFetchAll($sql);
//break;



// Pagination:
// Get number of hits per page
$hits = getGet("hits", 4);
if (!(is_numeric($hits) && $hits > 0 && $hits <= 8)) {
    die("Not valid for hits.");
}

// Get max number of pages
$sql_max = "SELECT COUNT(id) AS max FROM users;";
//$max = $db->executeFetchAll($sql);
$max = $app->database->getAllUsers($sql_max);
$max = ceil($max[0]->max / $hits);

// Get current page
$page = getGet("page", 1);
if (!(is_numeric($hits) && $page > 0 && $page <= $max)) {
    die("Not valid for page.");
}
$offset = $hits * ($page - 1);

// Get all users from db
$sql = "SELECT * FROM users ORDER BY $orderBy $order LIMIT $hits OFFSET $offset;";
//$sql = "SELECT * FROM users LIMIT $hits OFFSET $offset ORDER BY $orderBy $order;";
//$resultset = $db->executeFetchAll($sql);
// Get all users from db
$res = $app->database->getAllUsers($sql);


echo "<div class='profilediv'>";
echo "<hr class='leftmargin rightmargin'>";

echo "<p class='leftmargin'>Du är inloggad som: " . $session->get("name") . "</p>";


$defaultRoute = "admin_show?";
echo "<p class='leftmargin'>Användare per sida: ";
echo "<a href=" . mergeQueryString(['hits' => 2], $defaultRoute) . ">2</a> | ";
echo "<a href=" . mergeQueryString(["hits" => 4], $defaultRoute) . ">4</a> | ";
echo "<a href=" . mergeQueryString(["hits" => 8], $defaultRoute) . ">8</a>";
echo "</p>";

//echo "<p class='leftmargin'>Visa alla!</p>";
echo "<br>";


echo "<table class='leftmargin adminshow'>";
echo "<tr>";
echo "<th>Id " . orderby2('id', 'admin_show') . "</th>";
echo "<th>user " . orderby2('name', 'admin_show') . "</th>";
echo "<th>firstname " . orderby2('firstname', 'admin_show') . "</th>";
echo "<th>lastname " . orderby2('lastname', 'admin_show') . "</th>";
echo "<th>age " . orderby2('age', 'admin_show') . "</th>";
echo "<th>city " . orderby2('city', 'admin_show') . "</th>";
echo "<th>prof " . orderby2('profession', 'admin_show') . "</th>";
echo "<th>Intres " . orderby2('interest', 'admin_show') . "</th>";
echo "<th>Admin " . orderby2('admin', 'admin_show') . "</th>";
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



echo "<p class='leftmargin'>";
echo "Pages: ";
for ($i = 1; $i <= $max; $i++) {
    echo "<a href=" . mergeQueryString(["page" => $i], $defaultRoute) . ">" . $i . "</a> ";
}
echo "</p>";

/*
echo "<br>";
echo "orderBy " . $orderBy;
echo "<br>";
echo "order " . $order;
echo "<br>";
echo "hits " . $hits;
echo "<br>";
echo "max " . $max;
echo "<br>";
echo "page " . $page;
echo "<br>";
echo "offset " . $offset;
echo "<br>";
print_r($res);
//echo "" . $;
*/




echo "</div>";
//print_r($res)
