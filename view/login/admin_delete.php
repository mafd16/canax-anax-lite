<?php
// Include config
require_once("config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}


// If, get all usernames to dropdown
if (!isset($_POST["userselected"])) {
    $sql = "SELECT * FROM users;";
    $res = $app->database->getAllUsers($sql);
} else {
    // Else, get info about selected user
    $userInfo = $app->database->getUserInfo($_POST["userName"]);
    // Delete user from db
    $app->database->deleteUser($userInfo["id"]);
    // Set status message
    $status = "<p class='leftmargin'>Du har raderat användaren: " . $userInfo["name"] . "!</p>";
}


?>

<div class='profilediv'>
<hr class='leftmargin rightmargin'>
<p class='leftmargin'>Du är inloggad som: <?= $session->get("name") ?></p>


<form class="leftmargin rightmargin" method="post">
    <fieldset>
    <legend> *** Välj användare att radera ***</legend>
    <input type="hidden" name="userselected" value="true">
    <?php
    if (isset($_POST["userselected"])) {
        echo "<p><a href='admin_delete'>Välj på nytt</a></p>";
    }
    ?>

    <p>
        <label>Användare:<br>
        <select name="userName" required>
            <option value="">Välj användare</option>
            <?php foreach ($res as $row) : ?>
            <option value="<?= $row->name ?>"><?= $row->name ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>
    Är du säker?
    <input type="checkbox" required>
    <p>
        <input type="submit" name="doEdit" value="Radera">
    </p>
    </fieldset>
</form>

<?php
if (isset($_POST["userselected"])) {
    echo "<br>";
    echo $status;
}
?>

</div>
