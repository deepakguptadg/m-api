<?php
    $servername = "localhost";
    $username = "arustupv_app";
    $password = "Arustu@2022";
    $dbname = "arustupv_app";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
