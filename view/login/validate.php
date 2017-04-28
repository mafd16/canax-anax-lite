<?php
// Include config
require_once("config.php");

// Handle incoming POST variables
$user_name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;
$user_pass = isset($_POST["pass"]) ? htmlentities($_POST["pass"]) : null;


// Correspond according to input
// Check if both fields are filled
if ($user_name != null && $user_pass != null) {
    // Check if username exists
    //if ($db->exists($user_name)) {
    if ($app->database->exists($user_name)) {
        $get_hash = $app->database->getHash($user_name);
        // Verify user password
        if (password_verify($user_pass, $get_hash)) {
            $session->set("name", $user_name);

            $info = $app->database->getUserInfo($user_name);


            $session->set("firstname", $info['firstname']);
            $session->set("lastname", $info['lastname']);
            $session->set("age", $info['age']);
            $session->set("place", $info['city']);
            $session->set("prof", $info['profession']);
            $session->set("intres", $info['interest']);
            $session->set("admin", $info['admin']);

            header("Location: profile");
        } else {
            // Redirect to login.php
            echo "<br>";
            echo "<p>Användarnamnet eller lösenordet är fel. <a href='login'>Försök igen.</a></p>";
            echo "<br>";
        }
    } else {
        // Redirect to login.php
        echo "<br>";
        echo "<p>Fel användare. <a href='login'>Försök igen.</a></p>";
        echo "<br>";
    }
}
