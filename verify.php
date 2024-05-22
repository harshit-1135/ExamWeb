<?php 

$token=$_GET["token"];

$servername = "localhost";
$username = "root";
$password = "Harshit2053@";
$dbname = "examweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql=("UPDATE online_exam_teacher  SET activity='active' WHERE token='$token'");
$result = mysqli_query($conn, $sql);

header("Location: login.php?verified");


?>