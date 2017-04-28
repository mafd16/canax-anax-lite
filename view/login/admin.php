<?php
// Include config
require_once("config.php");

// Page only visible for admin
if (!$session->get("admin")) {
    header("Location: profile");
}

echo "<div class='profilediv'>";
echo "<hr class='leftmargin rightmargin'>";

echo "<p class='leftmargin'>Du är inloggad som: " . $session->get("name") . "</p>";
echo "</div>";
