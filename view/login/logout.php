<?php
// Include config
require_once("config.php");

echo "<div class='profilediv'>";

// Check if someone is logged in
if ($session->has("name")) {
    $session->destroy();
} else {
    echo "<p class='leftmargin'>Ingen är inloggad.</p>";
    //echo "<p><a href='login'>Logga in</a></p>";
    //die();
}

// Check if session is active
$has_session = session_status() == PHP_SESSION_ACTIVE;



if (!$has_session) {
    echo "<p class='leftmargin'>Din session är avslutad. Du har blivit utloggad!</p>";
}

//echo "<p>Destroyed session.</p>";

echo "<p class='leftmargin'><a href='login'>Logga in</a></p>";

echo "</div>";
