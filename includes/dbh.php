<?php
    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "php_procedural_login";

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }