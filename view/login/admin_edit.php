<?php
// Include config
require_once("config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}

$disabled = "";

// If, get all usernames to dropdown
if (!isset($_POST["userselected"])) {
    $sql = "SELECT * FROM users;";
    $res = $app->database->getAllUsers($sql);
} else {
    // Else, get info about selected user
    $userInfo = $app->database->getUserInfo($_POST["userName"]);
    //print_r($userInfo);
    // disable userselect
    $disabled = "disabled";
}

// Change password for user:
if (isset($_POST["newPass"])) {
    // Get posted values
    $new_pass = isset($_POST["new_pass"]) ? htmlentities($_POST["new_pass"]) : null;
    $re_pass = isset($_POST["re_pass"]) ? htmlentities($_POST["re_pass"]) : null;
    $theUserName = isset($_POST["theUserName"]) ? htmlentities($_POST["theUserName"]) : null;

    // Check if new password matches
    if ($new_pass == $re_pass) {
            $crypt_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $app->database->changePassword($theUserName, $crypt_pass);
            $status = "<p class='leftmargin'>Lösenordet ändrades för användaren: " . $theUserName . "!</p>";
    } else {
        $status = "<p class='leftmargin'>Lösenorden överensstämmer inte!</p>";
    }
}

// Change details for user:
if (isset($_POST['userUpdated'])) {
    // Handle incoming POST variables
    if (isset($_POST["theUserName"])) {
        $theUserName = htmlentities($_POST["theUserName"]);
    }
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
    if (isset($_POST["admin"])) {
        $admin = htmlentities($_POST["admin"]);
    }
    // Update db and session
    $userinfo = [$fname, $lname, $age, $place, $prof, $intres];
    $app->database->updateUser($userinfo, $theUserName, $admin);
    // Update message
    $status = "<p class='leftmargin'>Detaljer uppdaterades för användaren: " . $theUserName . "!</p>";
}


?>


<div class='profilediv'>
<hr class='leftmargin rightmargin'>
<p class='leftmargin'>Du är inloggad som: <?= $session->get("name") ?></p>


<form class="leftmargin rightmargin" method="post">
    <fieldset>
    <legend>Välj användare att redigera</legend>
    <input type="hidden" name="userselected" value="true">
    <?php if (isset($_POST["userselected"])) : ?>
         <p><a href="admin_edit">Välj på nytt</a></p>
    <?php endif; ?>
    <p>
        <label>Användare:<br>
        <select name="userName" required <?= $disabled?>>
            <option value="">Välj användare</option>
            <?php foreach ($res as $row) : ?>
            <option value="<?= $row->name ?>"><?= $row->name ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doEdit" value="Redigera" <?= $disabled?>>
    </p>
    </fieldset>
</form>

<?php if (isset($_POST["userselected"])) : ?>

<p class="leftmargin rightmargin">Redigera uppgifter för användare: <?= $userInfo["name"] ?></p>

<form class='leftmargin rightmargin' method="POST">
    <fieldset>
    <legend>Sätt nytt lösenord</legend>
    <input type="hidden" name="theUserName" value=<?= $userInfo["name"] ?>>
    <table>
        <tr>
            <td>Nytt lösenord:</td><td><input required type="password" name="new_pass"> *</td>
        </tr>
        <tr>
            <td>Upprepa lösenord:</td><td><input required type="password" name="re_pass"> *</td>
        </tr>
        <tr>
            <td><input type="submit" name="newPass" value="Sätt nytt lösenord"></td>
        </tr>
    </table>
</fieldset>
</form>
<br>
<?php endif; ?>

<?php
if (isset($_POST["userselected"])) {
    echo "<form class='leftmargin rightmargin' id='updateUserForm' method='POST'>";
    echo "<fieldset>";
    echo "<legend>Redigera detaljer</legend>";
    echo "<table class='profiletable'>";

    echo "<tr><td>Förnamn:</td><td><input type='text' name='firstname' value='" . $userInfo['firstname'] . "'></td></tr>";
    echo "<tr><td>Efternamn:</td><td><input type='text' name='lastname' value='" . $userInfo['lastname'] . "'></td></tr>";

    //echo "<tr><td>Användarnamn:</td><td>" . $userInfo['name'] . "</td></tr>";
    echo "<input type='hidden' name='theUserName' value=" . $userInfo["name"] . ">";

    echo "<tr><td>Ålder:</td><td><select name='age' form='updateUserForm'>";
    for ($i=0; $i < 130; $i++) {
        if ($i == $userInfo['age']) {
            echo "<option value=" . $i . " selected>" . $i . "</option>";
        } else {
            echo "<option value=" . $i . ">" . $i . "</option>";
        }
    }
    echo "</select></td></tr>";

    echo "<tr><td>Ort:</td><td><input type='text' name='place' value='" . $userInfo['city'] . "'></td></tr>";
    echo "<tr><td>Yrke:</td><td><input type='text' name='prof' value='" . $userInfo['profession'] . "'></td></tr>";
    echo "<tr><td>Intresse:</td><td><input type='text' name='intres' value='" . $userInfo['interest'] . "'></td></tr>";

    echo "<tr>";
    echo "<td>Admin:</td>";
    if ($userInfo['admin']) {
        echo "<td><input type='radio' name='admin' value=0> Nej";
        echo "<input type='radio' name='admin' value=1 checked> Ja</td>";
    } else {
        echo "<td><input type='radio' name='admin' value=0 checked> Nej";
        echo "<input type='radio' name='admin' value=1> Ja</td>";
    }
    echo "</tr>";

    echo "</table>";
    echo "<input type='submit' name='userUpdated' value='Spara ändringar'>";
    echo "</fieldset>";
    echo "</form>";
}




//<?php
if (isset($_POST["newPass"]) || isset($_POST['userUpdated'])) {
    echo "<br>";
    echo $status;
}
echo "<br>";
//print_r($_POST);
?>

</div>
