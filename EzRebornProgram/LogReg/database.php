<?php

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'ezrdb';
    $port = 3306;

    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

    if(!$conn) {
        echo "Connection Failed";
    }

?>
