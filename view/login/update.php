<?php
// Include config
require_once("config.php");

if (!$session->has("name")) {
    header("Location: login");
}





echo "<div class='profilediv'>";
echo "<p class='leftmargin'>Inloggad som: " . $session->get('name') . "</p>";


echo "<p class='leftmargin'><a href='logout'>Logga ut</a>";
echo " <a href='profile'>Tillbaka till profil</a></p>";

echo "<h1 class='leftmargin'>Redigera profil</h1>";
//echo "<div class='profilepicture'><img src='img/hitchcock.jpg'></div>";

echo "<figure class='profilepicture'><img src='image/hitchcock.jpg?w=170' alt='profile_picture'></figure>";

echo "<form id='updateform' action='profile' method='POST'>";
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

echo "<tr><td>Förnamn:</td><td><input type='text' name='firstname' value='" . $fname . "'></td></tr>";
echo "<tr><td>Efternamn:</td><td><input type='text' name='lastname' value='" . $lname . "'></td></tr>";

echo "<tr><td>Användarnamn:</td><td>" . $session->get('name') . "</td></tr>";
echo "<tr><td>Ålder:</td><td><select name='age' form='updateform'>";
for ($i=0; $i < 130; $i++) {
    if ($i == $age) {
        echo "<option value=" . $i . " selected>" . $i . "</option>";
    } else {
        echo "<option value=" . $i . ">" . $i . "</option>";
    }
}
echo "</select></td></tr>";

echo "<tr><td>Ort:</td><td><input type='text' name='place' value='" . $place . "'></td></tr>";
echo "<tr><td>Yrke:</td><td><input type='text' name='prof' value='" . $prof . "'></td></tr>";
echo "<tr><td>Intresse:</td><td><input type='text' name='intres' value='" . $intres . "'></td></tr>";
echo "</table>";
echo "<input type='hidden' name='updated' value='updated'>";
echo "<input type='submit' value='Spara ändringar'>";
echo "</form>";

echo "<br><br><br>";
//echo "<p><a href='info.php'>View session</a></p>";
echo "</div>";

//echo "<p><a href='change_password.php'>Change password</a></p>";
