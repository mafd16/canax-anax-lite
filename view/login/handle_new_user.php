<?php
/// Include config
require_once("config.php");

// Handle incoming POST variables
$user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
$user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;


echo "<div class='profilediv'>";
// Check if username exists
if (!$app->database->exists($user_name)) {
    // Check passwords match
    if ($user_pass != $re_user_pass) {
        echo "<p class='leftmargin'>Upprepningen av lösenord gick fel!</p>";
        //header("Refresh:2; create_user.php");
        header("Refresh:2; create");
    } else {
        // Make a hash of the password
        $crypt_pass = password_hash($user_pass, PASSWORD_DEFAULT);

        // Add user to database
        $app->database->addUser($user_name, $crypt_pass);


        //$ui = [null, null, null, null, null, null];
        //$app->database->updateUser($ui, $user_name, $admin = 0);
        // End test fullösning


        //echo $user_name;
        echo "<p class='leftmargin'>Användaren " . $user_name . " skapades!</p>";
        echo "<p class='leftmargin'><a href='login'>Logga in</a></p>";
    }
} else {
    echo "<p class='leftmargin'>Användaren finns redan! Välj ett annat användarnamn!</p>";
    //header("Refresh:2; create_user.php");
    header("Refresh:2; create");
}
echo "</div>";
