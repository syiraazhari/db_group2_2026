<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fruit_grocery_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
	echo "Connection failed";
}
else{
	echo "Connection successfully";
}
?>