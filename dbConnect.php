<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Make 'amec' the current database
    $dbName = "amec";
    $dbSelected = $conn->select_db($dbName);

    if (!$dbSelected) {
        // Create database if it doesn't already exist or if we can't call it
        $res = $conn->query("CREATE DATABASE $dbName");

        if ($res) {
            echo "Database $dbName created successfully\n";
        } else {
            echo 'Error creating database: ' . $conn->error . "\n";
        }
    }

    ini_set("display_errors", 1);
?>