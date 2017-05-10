<?php
// Include config
require_once("config.php");

if (!$session->has("name")) {
    header("Location: login");
}


// Handle incoming POST variables
if (isset($_POST["firstname"])) {
    $fname = htmlentities($_POST["firstname"]);
}
if (isset($_POST["lastname"])) {
    $lname = htmlentities($_POST["lastname"]);
}
if (isset($_POST["age"])) {
    $age = htmlentities($_POST["age"]);
}
if (isset($_POST["place"])) {
    $place = htmlentities($_POST["place"]);
}
if (isset($_POST["prof"])) {
    $prof = htmlentities($_POST["prof"]);
}
if (isset($_POST["intres"])) {
    $intres = htmlentities($_POST["intres"]);
}


//print_r($_POST);
//echo "------";
//$fname = $session->get('firstname');


// Update db and session
if (isset($_POST["updated"])) {
    $userinfo = [$fname, $lname, $age, $place, $prof, $intres];
    $app->database->updateUser($userinfo, $session->get('name'));

    $session->set("firstname", $fname);
    $session->set("lastname", $lname);
    $session->set("age", $age);
    $session->set("place", $place);
    $session->set("prof", $prof);
    $session->set("intres", $intres);
}


// Set the cookie!
//$cookie_name = "user";
//$cookie_value = $session->get("name");
//setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

// Visits through cookie
$cookie_name = "profile_visits";
if (isset($_COOKIE[$cookie_name])) {
    $visits = $_COOKIE[$cookie_name] + 1;
} else {
    $visits = 1;
}
setcookie($cookie_name, $visits, time() + (86400 * 30), "/");

//setcookie('user', $visits, time() - 1, "/");
//setcookie('age', $visits, time() - 1, "/");
//setcookie('visits', $visits, time() - 1, "/");

if (!$fname) {
    $fname = "Förnamn";
}
if (!$lname) {
    $lname = "Efternamn";
}

echo "<div class='profilediv'>";
echo "<p class='leftmargin'>Inloggad som: " . $session->get('name') . "</p>";

echo "<p class='leftmargin'><a href='logout'>Logga ut</a> <a href='change_password'>Byt lösenord</a>";
echo " <a href='update'>Redigera profil</a>";

if ($session->get("admin")) {
    echo " <a href='admin'>Administrera</a>";
}

echo " <a href='content'>Hantera innehåll</a>";

echo "</p>";

//echo "<div class='profilepicture'><img src='img/hitchcock.jpg'></div>";

echo "<figure class='profilepicture'><img src='image/hitchcock.jpg?w=170' alt='profile_picture'></figure>";

echo "<h1 class='profilename'>" . $fname . " " . $lname . "</h1>";
/*
echo "<ul class='profileul'>";
echo "<li>Användarnamn: " . $session->get('name') . "</li>";
echo "<li>Ålder: " . "</li>";
echo "<li>Ort: " . "</li>";
echo "<li>Yrke: " . "</li>";
echo "<li>Intresse: " . "</li>";
echo "</ul>";
*/
echo "<table class='profiletable'>";
echo "<tr><td>Användarnamn:</td><td>" . $session->get('name') . "</td></tr>";
echo "<tr><td>Ålder:</td><td>" . $age . "</td></tr>";
echo "<tr><td>Ort:</td><td>" . $place . "</td></tr>";
echo "<tr><td>Yrke:</td><td>" . $prof . "</td></tr>";
echo "<tr><td>Intresse:</td><td>" . $intres . "</td></tr>";
echo "</table>";

echo "<br><br>";

echo "<div class='cookiediv'>";
if (!isset($_COOKIE[$cookie_name])) {
    echo "<p>Cookie named '" . $cookie_name . "' is not set!</p>";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
echo "</div>";

//print_r($_COOKIE);

echo "</div>";
/*
echo "<h1 class='clearboth'>Welcome!</h1>";

echo "<p>You are logged in as " . $session->get('name') . "</p>";
*/
//echo "<p><a href='info.php'>View session</a></p>";


//echo "<p><a href='change_password.php'>Change password</a></p>";
