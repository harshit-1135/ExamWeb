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
session_start();
$exam_id = $_SESSION["exam_id"];
$sql3 = "SELECT * FROM exams WHERE exam_id='$exam_id'";
$result3 = mysqli_query($conn, $sql3);
$email_count3 = mysqli_num_rows($result3);
if($email_count3) {
    $email_pass = mysqli_fetch_assoc($result3);
    $_SESSION['duration'] = $email_pass['duration'];}
    $_SESSION["scheduledDate"]=$email_pass["scheduledDate"];
$date = date("Y-m-d H:i:s");

$_SESSION["end_time"]=date("Y-m-d H:i:s",strtotime($date."+$_SESSION[duration] minutes"));
$_SESSION["start_time"]=$date;
$_SESSION["exam_start"]="yes";

$myRange = $_POST["myRange"];
$favcolor = $_POST["favcolor"];
$_SESSION["favcolor"]=$favcolor;
$_SESSION["myRange"]=$_POST["myRange"];
$student_id = $_SESSION["studentID"];


header("Location: camera.php");		
?>
