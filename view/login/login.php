<?php
// Include config
require_once("config.php");

$user_loggedin = "";

// Make sure no one is logged in
if ($session->has("name")) {
    echo "<p class='leftmargin'>Du är redan inloggad som " . $session->get('name') . "</p>";
    echo "<p class='leftmargin'><a href='logout'>Logga ut</a> <a href='profile'>Profilsida</a></p>";
    $user_loggedin = "disabled";
}

?>





<div class='profilediv'>



<form class='leftmargin' action="validate" method="POST">
    <table>
        <legend><h3>Logga in</h3></legend>
        <tr>
            <td>Användarnamn:</td><td><input type="text" name="name" autofocus required <?=$user_loggedin?>></td>
        </tr>
        <tr>
            <td>Lösenord:</td><td><input type="password" name="pass" required <?=$user_loggedin?>></td>
        </tr>
        <tr>
            <td><input type="submit" name="submitForm" value="Login" <?=$user_loggedin?>></td>
        </tr>
    </table>
</form>
<br>
<p class='leftmargin'><a href="create">Skapa ny användare</a></p>
<br>
</div>
