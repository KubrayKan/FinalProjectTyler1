<?php 
// Database configuration 
    $servername = "localhost";
    $username = "root";
    $password ="";
    $database ="loltyler1merch";

    // Create database connection 
    $db = new mysqli($servername, $username, $password, $database); 
    
    // Check connection 
    if ($db->connect_error) { 
        die("Connection failed: " . $db->connect_error); 
    }
?>