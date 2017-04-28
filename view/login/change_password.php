<?php
// Include config
require_once("config.php");

$user = $session->get("name");
$status = "Change password";

// Handle incoming POST variables
$old_pass = isset($_POST["old_pass"]) ? htmlentities($_POST["old_pass"]) : null;
$new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
$re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;

// Check if all fields are filled
if ($old_pass != null && $new_pass != null && $re_pass != null) {
    // Check if old password is correct
    if (password_verify($old_pass, $app->database->getHash($user))) {
        // Check if new password matches
        if ($new_pass == $re_pass) {
                $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $app->database->changePassword($user, $crypt_pass);
                $status = "Lösenordet ändrades!";
        } else {
            $status = "Lösenorden överensstämmer inte!";
        }
    } else {
        $status = "Det gamla lösenordet är fel!";
    }
} else {
    $status = "Fyll i alla fält!";
}

?>
<div class="profilediv">
<p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>

<p class='leftmargin'><a href='logout'>Logga ut</a> <a href='profile'>Profilsida</a></p>

<form class='leftmargin' action="change_password" method="POST">
    <table>
        <legend><h3><?=$status?></h3></legend>
        <tr>
            <td>Old pass:</td><td><input type="password" name="old_pass"></td>
        </tr>
        <tr>
            <td>New pass:</td><td><input type="password" name="new_pass"></td>
        </tr>
        <tr>
            <td>Re-enter pass:</td><td><input type="password" name="re_pass"></td>
        </tr>
        <tr>
            <td><input type="submit" name="submitForm" value="Change password"></td>
        </tr>
    </table>
</form>
<br>
</div>
