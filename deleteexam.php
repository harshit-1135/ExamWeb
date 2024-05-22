<?php 


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
$exam_id = $_GET["exam_id"];
$sql = "DELETE FROM exams WHERE exam_id='$exam_id'";
if(mysqli_query($conn, $sql)){
    header("Location: dashboard.php?examDeleted");
} 
?>
