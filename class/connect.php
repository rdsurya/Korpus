<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "korpus"; // tukar jadi CS


// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

?>