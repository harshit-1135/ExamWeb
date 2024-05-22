<?php
$question_id = $_GET["question_id"];
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
$sql = "DELETE FROM questions WHERE question_id='$question_id'";
if(mysqli_query($conn, $sql)){
    header("Location: dashboard.php?QuestionDeleted");
} 

?>