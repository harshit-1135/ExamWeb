<?php
$img = $_POST['image'];
$folderPath = 'captured_Images/';
$image_parts = explode(";base64,",$img);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = $folderPath . uniqid() . '.png';
file_put_contents($file, $image_base64);
$servername = "localhost";
$username = "root";
$password = "Harshit2053@";
$dbname = "examweb";

session_start();
$student_id = $_SESSION['studentID'];
$favcolor = $_SESSION["favcolor"];
$myrange = $_SESSION["myRange"];

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "INSERT INTO customizations (font_size,color,student_id) VALUES ('$myrange','$favcolor','$student_id')";
    if ($conn->query($sql) === TRUE) {

// Create connection


$sql=("UPDATE students  SET photo='$file' WHERE student_id='$student_id'");
	if ($conn->query($sql) === TRUE) {
	
        header("location:exam.php");
} else {
	
    echo "Error: " . $sql . "<br>" . $conn->error;
} }

?>