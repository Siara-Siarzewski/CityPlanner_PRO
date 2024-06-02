<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cityplanner_pro";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>