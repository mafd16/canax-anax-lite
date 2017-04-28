<?php
// Include config
require_once("config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}

// Handle incoming POST variables
$user_name = isset($_POST["new_name"]) ? htmlentities($_POST["new_name"]) : null;
$user_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_user_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
$firstname = isset($_POST["firstname"]) ? htmlentities($_POST["firstname"]) : null;
$lastname = isset($_POST["lastname"]) ? htmlentities($_POST["lastname"]) : null;
$age = isset($_POST["age"]) ? htmlentities($_POST["age"]) : null;
$city = isset($_POST["city"]) ? htmlentities($_POST["city"]) : null;
$profession = isset($_POST["profession"]) ? htmlentities($_POST["profession"]) : null;
$interest = isset($_POST["interest"]) ? htmlentities($_POST["interest"]) : null;
$admin = isset($_POST["admin"]) ? htmlentities($_POST["admin"]) : null;

// Confirmation message
$message = null;

// Check if username exists
if (!$app->database->exists($user_name) && $user_name) {
    // Check passwords match
    if ($user_pass != $re_user_pass) {
        $message = "<p class='leftmargin'>Upprepningen av lösenord gick fel!</p>";
        //header("Refresh:2; create_user.php");
        //header("Refresh:2; create");
    } else {
        // Make a hash of the password
        $crypt_pass = password_hash($user_pass, PASSWORD_DEFAULT);
        // Add user to database
        $app->database->addUser($user_name, $crypt_pass);
        // Update user with values from post
        $ui = [
            $firstname,
            $lastname,
            $age,
            $city,
            $profession,
            $interest
        ];
        $app->database->updateUser($ui, $user_name, $admin);

        $message = "<p class='leftmargin'>Användaren " . $user_name . " skapades!</p>";
    }
} elseif ($user_name) {
    $message = "<p class='leftmargin'>Användaren finns redan! Välj ett annat användarnamn!</p>";
    //header("Refresh:2; create_user.php");
    //header("Refresh:2; create");
}


?>

<div class='profilediv'>
<hr class='leftmargin rightmargin'>
<p class='leftmargin'>Du är inloggad som: <?= $session->get("name") ?></p>


<form class='leftmargin' id='createform' action="admin_add" method="POST">
    <table>
        <legend><h3>Skapa användare</h3></legend>
        <p>Fält med * är obligatoriska</p>
        <tr>
            <td>Användarnamn:</td><td><input type="text" name="new_name" required> *</td>
        </tr>
        <tr>
            <td>Lösenord:</td><td><input type="password" name="new_pass" required> *</td>
        </tr>
        <tr>
            <td>Upprepa lösenord:</td><td><input type="password" name="re_pass" required> *</td>
        </tr>
        <tr>
            <td>Förnamn:</td><td><input type="text" name="firstname"></td>
        </tr>
        <tr>
            <td>Efternamn:</td><td><input type="text" name="lastname"></td>
        </tr>

        <?php
        echo "<tr><td>Ålder:</td><td><select name='age' form='createform'>";
        for ($i=0; $i < 130; $i++) {
            echo "<option value=" . $i . ">" . $i . "</option>";
        }
        echo "</select></td></tr>";
        ?>
        <!--<tr>
            <td>Ålder:</td><td><input type="text" name="age"></td>
        </tr>-->
        <tr>
            <td>Ort:</td><td><input type="text" name="city"></td>
        </tr>
        <tr>
            <td>Yrke:</td><td><input type="text" name="profession"></td>
        </tr>
        <tr>
            <td>Intresse:</td><td><input type="text" name="interest"></td>
        </tr>
        <tr>
            <td>Admin:</td>
            <td><input type="radio" name="admin" value=0 checked> Nej
            <input type="radio" name="admin" value=1> Ja</td>
        </tr>
        <tr>
            <td><input type="submit" name="submitCreateForm" value="Create"></td>
        </tr>
    </table>
</form>

<br>
<?= $message ?>
<!--<p class="leftmargin"><a href='login'>Tillbaka till login</a></p>-->
<br>
</div>
