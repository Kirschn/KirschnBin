<?php
if (isset($_POST["submit"]) && isset($_POST["text"])) {
    include "config.php";
    $sqlconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbtable);
    echo "SQL: INSERT INTO `kirschnbin`.`entrys` (`id`, `text`) VALUES (NULL, ".mysqli_real_escape_string($sqlconnection, $_POST["text"]).");";
    mysqli_query($sqlconnection, "INSERT INTO `kirschnbin`.`entries` (`id`, `text`) VALUES (NULL, \"".mysqli_real_escape_string($sqlconnection, $_POST["text"])."\");");
    $id=mysqli_insert_id($sqlconnection);
    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?id=$id");
    mysqli_close($sqlconnection);
} else if (isset($_GET["id"])) {
    include 'config.php';
    $sqlconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbtable);
    $sqlresult = mysqli_query($sqlconnection, "SELECT text FROM entries WHERE id=\"".mysqli_real_escape_string($sqlconnection, $_GET["id"])."\";");
    echo mysqli_error($sqlconnection);
    if ($sqlresult !== false) {
    $text = mysqli_fetch_array($sqlresult)[0];
    header("Content-Type: text/plain");
    echo str_replace("\r", "<br>", $text);
    mysqli_close($sqlconnection);
    } else {
        header("Location: https://pasteload.tk");
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>
            KirschnBin Create Form
        </title>
        <style>
            body {
                margin: 0;
            }
            #textbox {
                width: 99vw;
                height: 95vh;
            }
        </style>
    </head>
    <body>
        <form action="<?php echo "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" method="POST">
            <textarea name="text" placeholder="Text here..." id="textbox"></textarea>
            <input type="submit" value="Submit" name="submit">
        </form>
    </body>
    </html>
    <?php
} die();