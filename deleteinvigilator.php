<?php
$invigilator_id = $_GET["invigilator_id"];
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
$sql = "DELETE FROM invigilators WHERE invigilator_id='$invigilator_id'";
if(mysqli_query($conn, $sql)){
    header("Location: dashboard.php?studentDeleted");
} 

?>