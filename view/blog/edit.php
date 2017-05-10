<?php
// Include config
require_once("../view/login/config.php");

if (!$session->has("name")) {
    header("Location: login");
}

// if, Get updated values from POST
if (isset($_POST["doSave"])) {
    //$params gets all values from getPost()
    $params = getPost([
        "contentTitle",
        "contentPath",
        "contentSlug",
        "contentData",
        "contentType",
        "contentFilter",
        "contentPublish",
        "contentId"
    ]);

    if (!$params["contentSlug"]) {
        $params["contentSlug"] = slugify($params["contentTitle"]);
    }
    if (!$params["contentPath"]) {
        $params["contentPath"] = null;
    }
    if (!$params["contentFilter"]) {
        $params["contentFilter"] = 'nl2br';
    }

    $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
    //$app->database->execute($sql, array_values($params));
    try {
        $app->database->execute($sql, array_values($params));
    } catch (Exception $e) {
        //echo $e->getMessage();
        echo "<br><div class='leftmargin rightmargin alert'>";
        echo "<p>Fältet 'Path' eller 'Slug' är identiskt med ett annat inlägg. ";
        echo "Välj ett unikt värde i fältet 'Path' eller 'Slug'. </p>";
        //echo "<a href='edit?id='"
        echo '<a id="displayText" href="javascript:toggle();">Mer information</a>';
        echo '<div id="toggleText" style="display: none"><br>' . $e->getMessage() . '</div></div>';
    }

    //header("Location: ?route=edit&id=$movieId");
    $contentId = $params["contentId"];
} else {
    // Get id from querystring
    $contentId = getGet('id');
}
if (!is_numeric($contentId)) {
    die("Not valid for content id.");
}

// Get content with correct id
$sql = "SELECT * FROM content WHERE id = ?;";
$content = $app->database->executeFetch($sql, [$contentId]);

if (!$content) {
    echo "No such entry in database!";
}

//print_r($content);

?>

<div class="profilediv">

    <p class='leftmargin'>Inloggad som: <?= $session->get('name') ?></p>
    <a class="leftmargin" href='profile'>Tillbaka till Profil</a>
    <a href='content'>Hantera innehåll</a>
    <br>
    <br>

    <form method="POST">
        <fieldset class="leftmargin rightmargin">
            <legend>Edit</legend>
            <p>
                <label>Title:<br>
                <input type="text" name="contentTitle" value="<?= htmlentities($content->title) ?>"/>
            </p>
            <p>
                <label>Path:<br>
                <input type="text" name="contentPath" value="<?= htmlentities($content->path) ?>"/>
            </p>
            <p>
                <label>Slug:<br>
                <input type="text" name="contentSlug" value="<?= htmlentities($content->slug) ?>"/>
            </p>
            <p>
                <label>Text:<br>
                <textarea name="contentData"><?= htmlentities($content->data) ?></textarea>
            </p>
            <p>
                <label>Type:<br>
                <input type="text" name="contentType" value="<?= htmlentities($content->type) ?>"/>
            </p>
            <p>
                <label>Filter:<br>
                <input type="text" name="contentFilter" value="<?= htmlentities($content->filter) ?>"/>
            </p>
            <p>
                <label>Publish:<br>
                <input type="datetime" name="contentPublish" value="<?= htmlentities($content->published) ?>"/>
            </p>
            <input type="hidden" name="contentId" value="<?= htmlentities($content->id) ?>">
            <input type="submit" name="doSave" value="Save">
            <input type="reset" value="Reset">
            <input type="button" onclick="location.href='delete_content?id=<?= $content->id ?>'" value="Delete">
        </fieldset>
    </form>
    <br>
</div>

<script language="javascript">
function toggle() {
    var ele = document.getElementById("toggleText");
    var text = document.getElementById("displayText");
    if(ele.style.display == "block") {
        ele.style.display = "none";
        text.innerHTML = "Mer information";
    }
    else {
        ele.style.display = "block";
        text.innerHTML = "Mindre information";
    }
}
</script>
