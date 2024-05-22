<?php

session_start();
var_dump($_FILES);
$filename ='recorded_videos/'.uniqid().'.mp4';
move_uploaded_file($_FILES['blobFile']['tmp_name'],$filename);
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

$sql=("UPDATE students  SET video='$filename' WHERE student_id='$_SESSION[studentID]'");
	if ($conn->query($sql) === TRUE) {
	
     header("Location : end.php");
} else {
	
    echo "Error: " . $sql . "<br>" . $conn->error;
} 
?>