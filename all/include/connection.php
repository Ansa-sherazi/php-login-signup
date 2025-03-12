<?php 

$server = "localhost";
$username = "root";
$dbpass = "";
$dbname = "my_project";

$connection = mysqli_connect($server, $username, $dbpass, $dbname);

if (!$connection) {
    die("Failed to connect");
} else {
    // echo "Connected"; 
}
?>
