<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ezrdb';
    $port = 3306;
    $charset = 'utf8mb4'; 

    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    if (!$conn) {
        echo "Connection Failed: ". mysqli_connect_error();
        exit();
    }

    
    if (!mysqli_set_charset($conn, $charset)) {
        echo "Error setting character encoding: ". mysqli_error($conn);
        exit();
    }

    
    if (!mysqli_select_db($conn, $dbname)) {
        echo "Error selecting database: ". mysqli_error($conn);
        exit();
    }

?>
