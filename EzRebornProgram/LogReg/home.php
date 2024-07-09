<?php
session_start();
include('database.php');

if (!isset($_SESSION['id']) && isset($_SESSION['fname'])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>EZReborn Home Page</title>
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <h1>Welcome to EZReborn Esports Website <?php echo $_SESSION['fname']; ?></h1>
            <a href="logout.php"> Log out</a>
        </body>
    </html>
    
    <?php
}
else {
    header("Location: index.php");
    exit();
}
?>