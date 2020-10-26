<?php
 $dbhost="localhost";
 $dbuser="root";
 $dbpass="mysql";
 $dbname="exam";

 // Create connection
 global $conn;
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully with mysql";
?>