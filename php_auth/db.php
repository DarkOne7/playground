<?php
$hostname="localhost";
$db_name = "php_auth";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $dbname);


if ($conn-> connect_error) {
    die("Connection failed: " . $conn->connect_error);

}



?>