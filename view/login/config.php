<?php
// Include Session
//require_once("Session.php");
//require_once(dirname(__FILE__) . "..\..\src\Database\Database.php");
//require "../../src/Database/Database.php";


//echo dirname(__FILE__);

/**
 * Details for connecting to the database.
 */
$databaseConfig = [
    "dsn"      => "mysql:host=localhost;dbname=melogin;",
    "login"    => "user",
    "password" => "pass",
    "options"  => [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
];


//$fileName = __DIR__ . "/db/oophp.sqlite";
//$db = new Database();
//$app->database = new Database();
$app->database->connect($databaseConfig);
//$db->connect($databaseConfig);

//$db = new Connect("sqlite:$fileName");

// Start the session
//$session = new Marton\Session\Session("LOGINSESSION");
//$session->start();

$session = new Marton\Session\Session("LOGINSESSION");
$session->start();


/*
if ($session->has("name")) {
    $user = $session->get("name");
    $res = $app->database->getUserInfo($user);
}
*/

// Get the name from session
if ($session->has('firstname')) {
    $fname = $session->get('firstname');
} else {
    $fname = "Förnamn";
}
if ($session->has('lastname')) {
    $lname = $session->get('lastname');
} else {
    $lname = "Efternamn";
}
// get age
if ($session->has('age')) {
    $age = $session->get('age');
} else {
    $age = " - ";
}
// get place
if ($session->has('place')) {
    $place = $session->get('place');
} else {
    $place = " - ";
}
// get profession
if ($session->has('prof')) {
    $prof = $session->get('prof');
} else {
    $prof = " - ";
}
// get intresse
if ($session->has('intres')) {
    $intres = $session->get('intres');
} else {
    $intres = " - ";
}
