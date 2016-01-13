<?php
/**
 * Created by PhpStorm.
 * User: mcwmc
 * Date: 13.01.2016
 * Time: 21:30
 */
// SETUP: Create sqlinit.php
// This file contains a single line to initialize the MySQL Connection
if (isset($_POST["submit"]) && isset($_POST["text"])) {
    // Create mechanic, than redirect to id parameter
    include 'sqlinit.php';
    mysqli_query($sqlconnection, "INSERT INTO entrys (text) VALUES (".mysqli_real_escape_string($sqlconnection, $_POST["text"]).");");
    $id=mysqli_insert_id($sqlconnection);
    header("Location: http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}?id=$id");
} else if (isset($_GET["id"])) {
    // Output, can be routed in Webserver Config
    include 'sqlinit.php';
    $text = mysqli_fetch_array(mysqli_query($sqlconnection, "SELECT text FROM entrys WHERE id=".mysqli_real_escape_string($sqlconnection, $_GET["id"]).";"))[0];
    echo $text;
    die();
} else {
    // Input From
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>
            KirschnBin Create
        </title>
        <style>
            body {
                margin: 0;
            }
            #textbox {
                width: 100vw;
                height: 100vh;
            }
        </style>
    </head>
    <body>
        <form action="<?php echo "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; ?>" method="POST">
            <textarea name="text" placeholder="Text here..." id="textbox"></textarea>
            <input type="submit" value="Submit" name="submit">
        </form>
    </body>
    </html>
    <?php
}