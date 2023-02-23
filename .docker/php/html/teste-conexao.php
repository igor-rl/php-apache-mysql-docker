<?php
$host = 'mysql';
$user = 'root';
$pass = 'root';
$db = 'teste';

$conn = new mysqli($host, $user, $pass, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL server successfully!";
$conn->close();
