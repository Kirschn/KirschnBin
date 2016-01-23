<?php
if (isset($_POST["submit"]) && isset($_POST["text"])) {
    include "config.php";
    $sqlconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbtable);
    echo "SQL: INSERT INTO `kirschnbin`.`entrys` (`id`, `text`) VALUES (NULL, ".mysqli_real_escape_string($sqlconnection, $_POST["text"]).");";
    mysqli_query($sqlconnection, "INSERT INTO `kirschnbin`.`entries` (`id`, `text`) VALUES (NULL, \"".mysqli_real_escape_string($sqlconnection, $_POST["text"])."\");");
    $id=mysqli_insert_id($sqlconnection);
    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}$id");
    mysqli_close($sqlconnection);
} else if (isset($_GET["id"])) {
    include 'config.php';
    $sqlconnection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbtable);
    $loadid = str_replace("/", "", $_GET["id"]);
    $sqlresult = mysqli_query($sqlconnection, "SELECT text FROM entries WHERE id=\"".mysqli_real_escape_string($sqlconnection, $loadid)."\";");
    if ($sqlresult !== false) {
    $text = mysqli_fetch_array($sqlresult)[0];
    header("Content-Type: text/plain");
    echo $text;
    mysqli_close($sqlconnection);
    } else {
        echo "paste does not exist";
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
            .button {
                display: block;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <form action="<?php echo "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" method="POST">
            <textarea name="text" placeholder="Text here..." id="textbox"></textarea>
            <input type="submit" value="Submit" name="submit" class="button">
        </form>
    </body>
    </html>
    <?php
} die();