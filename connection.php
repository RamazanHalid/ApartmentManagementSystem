<?php
$servername   = "localhost";
$username     = "root";
$password     = "";
$databasename = "apartment";


// Create database connection
$conn = new mysqli($servername, $username, $password, $databasename);

// Check database connection
if ($conn->connect_error) 
   {
     die("Connection failed: " . $conn->connect_error);
   }
?>